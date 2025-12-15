<div x-data="chatBot()" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="bg-gray-900 border border-gray-700 w-80 sm:w-96 md:w-[28rem] h-[32rem] rounded-2xl shadow-2xl flex flex-col overflow-hidden mb-6 mr-2"
         style="display: none;">


        <div class="bg-gray-800 p-4 border-b border-gray-700 flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-2.5 h-2.5 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                <div>
                    <h3 class="text-white font-bold text-base">FitBot Assistant</h3>
                    <p class="text-xs text-gray-400">Ask me about training & nutrition</p>
                </div>
            </div>
            <button @click="toggleChat" class="text-gray-400 hover:text-white focus:outline-none transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="flex-1 p-5 overflow-y-auto space-y-6 bg-gray-900 scroll-smooth" id="chat-messages">

            <div class="flex items-start">
                <div class="bg-gray-800 text-gray-200 text-sm p-4 rounded-2xl rounded-tl-none shadow-md max-w-[85%] leading-relaxed border border-gray-700">
                    Hello! I'm FitBot. Ask me anything about your training routine, diet plan, or how to use the app! 💪
                </div>
            </div>

            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                    <div class="text-sm p-4 rounded-2xl shadow-md max-w-[85%] leading-relaxed"
                         :class="msg.role === 'user' ? 'bg-green-600 text-white rounded-tr-none' : 'bg-gray-800 text-gray-200 rounded-tl-none border border-gray-700'">
                        <span x-text="msg.content"></span>
                    </div>
                </div>
            </template>

            <div x-show="isLoading" class="flex items-start">
                <div class="bg-gray-800 text-gray-400 text-xs p-4 rounded-2xl rounded-tl-none shadow-md flex items-center space-x-1 border border-gray-700">
                    <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></span>
                    <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce delay-75"></span>
                    <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce delay-150"></span>
                </div>
            </div>
        </div>

        <div class="p-4 bg-gray-800 border-t border-gray-700">
            <form @submit.prevent="sendMessage" class="flex items-center space-x-3">
                <input type="text" x-model="newMessage" placeholder="Type a message..."
                       class="flex-1 bg-gray-900 border border-gray-600 text-white text-sm rounded-xl focus:ring-green-500 focus:border-green-500 p-3 placeholder-gray-500 shadow-inner"
                       :disabled="isLoading">
                <button type="submit"
                        class="bg-green-500 hover:bg-green-400 text-black rounded-xl p-3 transition transform hover:scale-105 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="!newMessage.trim() || isLoading">
                    <svg class="w-5 h-5 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <button @click="toggleChat"
            class="bg-green-500 hover:bg-green-400 text-black w-16 h-16 rounded-full shadow-2xl flex items-center justify-center transition transform hover:scale-110 focus:outline-none z-50 border-4 border-gray-900">
        <svg x-show="!isOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <svg x-show="isOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>

</div>

<script>
function chatBot() {
    return {
        isOpen: false,
        isLoading: false,
        newMessage: '',
        messages: [],

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async sendMessage() {
            const userText = this.newMessage.trim();
            if (!userText) return;


            this.messages.push({ role: 'user', content: userText });
            this.newMessage = '';
            this.isLoading = true;
            this.$nextTick(() => this.scrollToBottom());

            try {
                const response = await fetch('{{ route('chatbot.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: userText,
                        history: this.messages.slice(-6)
                    })
                });

                const data = await response.json();

                if (data.status === 'success') {
                    this.messages.push({ role: 'assistant', content: data.reply });
                } else {
                    this.messages.push({ role: 'assistant', content: 'Error: Could not get response.' });
                }

            } catch (error) {
                console.error('Chat error:', error);
                this.messages.push({ role: 'assistant', content: 'Sorry, something went wrong. Please try again.' });
            } finally {
                this.isLoading = false;
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        scrollToBottom() {
            const container = document.getElementById('chat-messages');
            if(container) {
                container.scrollTop = container.scrollHeight;
            }
        }
    }
}
</script>
