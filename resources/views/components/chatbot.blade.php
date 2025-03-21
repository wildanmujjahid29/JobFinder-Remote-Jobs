<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div>
    <button
    class="fixed z-50 p-4 text-white border border-white rounded-full shadow-lg bg-gradient-to-r from-blue-500 to-blue-600 bottom-4 right-4 hover:bg-blue-700"
    onclick="toggleChatModal(true)">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-message-circle">
        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
    </svg>
</button>

<!-- Chat Modal -->
<div id="chat-modal"
    class="fixed bottom-20 right-4 w-96 h-[500px] bg-white border border-gray-300 rounded-lg shadow-lg hidden z-50 flex-col">
    <!-- Chat Header -->
    <div class="flex items-center justify-between p-3 rounded-t-lg bg-gradient-to-r from-blue-500 to-blue-600">
        <span class="text-sm font-medium text-white">AI Chat Assistant</span>
        <button class="font-bold text-white hover:text-red-500" onclick="toggleChatModal(false)">
            X
        </button>
    </div>

    <div id="chat-messages"
    class="flex-1 p-3 space-y-3 overflow-y-auto bg-gray-50 scrollbar-thin scrollbar-thumb-blue-400">
        <!-- Initial Welcome Message -->
        <div class="flex items-start space-x-2 message bot">
            <img src="img/bot.png" alt="AI" class="w-6 h-6 font-thin rounded-full">
            <span class="inline-block p-2 text-sm bg-white shadow-md rounded-lg max-w-[80%]">
                Hello! I'm your AI assistant. How can I help you today?
            </span>
        </div>
    </div>
    <!-- Chat Input -->
    <div class="p-3 bg-gray-100 border-t border-gray-300">
        <form id="chat-form" class="flex space-x-2">
            @csrf
            <input 
                id="chat-input" 
                type="text" 
                class="flex-1 p-2 text-xs border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Type your message..."
                required
            />
            <button type="submit" 
                class="p-2 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Send
            </button>
        </form>
    </div>
</div>

<script>
function toggleChatModal(show) {
    const modal = document.getElementById('chat-modal');
    if (show) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

$(document).ready(function() {
    function addLoadingIndicator() {
        const typingIndicator = `
            <div id="loading-indicator" class="flex items-start space-x-2">
                <img src="img/bot.png" alt="AI" class="w-6 h-6 rounded-full">
                <div class="inline-block p-2 text-sm bg-white shadow-md rounded-lg max-w-[80%]">
                    <div class="flex space-x-1 dots-container">
                        <div class="w-2 h-2 bg-gray-400 rounded-full dot animate-bounce delay-0"></div>
                        <div class="w-2 h-2 delay-150 bg-gray-400 rounded-full dot animate-bounce"></div>
                        <div class="w-2 h-2 delay-300 bg-gray-400 rounded-full dot animate-bounce"></div>
                    </div>
                </div>
            </div>
        `;
        $('#chat-messages').append(typingIndicator);
        scrollToBottom();
    }

    function removeLoadingIndicator() {
        $('#loading-indicator').remove();
    }

    function addBotMessageWithAnimation(message) {
        const messageDiv = $('<div>').addClass('flex justify-start items-start space-x-2');
        const messageContent = $('<div>').addClass(
            'max-w-[70%] rounded-lg px-3 py-2 bg-blue-100 text-gray-800 shadow-md text-xs'
        );
        messageContent.append('<span></span>'); 
        messageDiv.append('<img src="img/bot.png" alt="AI" class="w-6 h-6 rounded-full">');
        messageDiv.append(messageContent);
        $('#chat-messages').append(messageDiv);

        scrollToBottom();

        const span = messageContent.find('span');
        let index = 0;

        const interval = setInterval(() => {
            span.append(message[index]);
            index++;
            if (index >= message.length) {
                clearInterval(interval);
            }
            scrollToBottom();
        }, 30); 
    }

    function addUserMessage(message) {
        const messageDiv = $('<div>').addClass('flex justify-end items-start space-x-2');
        const messageContent = $('<div>').addClass(
            'max-w-[70%] rounded-lg px-3 py-2 bg-blue-500 text-white shadow-md text-xs'
        );
        messageContent.text(message);
        messageDiv.append(messageContent);
        $('#chat-messages').append(messageDiv);

        scrollToBottom();
    }

    function scrollToBottom() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    $('#chat-form').on('submit', function(e) {
        e.preventDefault();

        const message = $('#chat-input').val();
        if (!message) return;

        addUserMessage(message);
        $('#chat-input').val('');

        addLoadingIndicator();

        $.ajax({
            url: '/send-message',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                message: message
            },
            success: function(response) {
                removeLoadingIndicator();
                if (response.success) {
                    addBotMessageWithAnimation(response.message);
                } else {
                    addBotMessageWithAnimation('Oops, something went wrong.');
                }
            },
            error: function() {
                removeLoadingIndicator();
                addBotMessageWithAnimation('Error sending your message.');
            }
        });
    });
});
</script>

<style>
.animate-bounce {
    animation: bounce 1.5s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.delay-150 { animation-delay: 0.15s; }
.delay-300 { animation-delay: 0.3s; }
</style>
</div>