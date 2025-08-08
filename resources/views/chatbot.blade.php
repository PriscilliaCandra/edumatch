@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-light rounded-pill d-inline-flex align-items-center shadow-sm px-3 py-2">
            <i class="fas fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-11 col-md-9 col-lg-7">
            <div class="card shadow-lg border-0 rounded-4 d-flex flex-column" style="min-height: 80vh;">
                <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center rounded-top-4 py-3 px-3">
                    <h5 class="mb-0 text-center">EduBot</h5>
                </div>

                <div class="card-body p-3 d-flex flex-column flex-grow-1">
                    <div id="chat-messages" class="flex-grow-1 overflow-auto mb-3 pe-1" style="max-height: calc(80vh - 200px); scroll-behavior: smooth;">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-robot me-1"></i> Selamat datang di EduBot! AI Agent yang siap membantumu seputar dunia perkuliahan 24/7.
                        </div>
                    </div>

                    <div id="chat-loading" class="text-center text-primary mb-2" style="display: none;">
                        <i class="fas fa-spinner fa-spin me-2"></i>Mengetik...
                    </div>

                    <div id="chat-error" class="alert alert-danger py-2 px-3 mb-2 small d-none"></div>

                    <div class="input-group">
                        <input type="text" id="user-message-input" class="form-control rounded-start-pill py-2 px-3" placeholder="Tulis pesan..." aria-label="Ketik pertanyaan Anda">
                        <button class="btn btn-primary rounded-end-pill px-4" type="button" id="send-message-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessagesContainer = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-message-input');
    const sendMessageBtn = document.getElementById('send-message-btn');
    const chatLoading = document.getElementById('chat-loading');
    const chatError = document.getElementById('chat-error');

    function getJwtToken() {
        return localStorage.getItem('jwt_token');
    }

    function displayMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('d-flex', 'mb-2'); 
        
        const messageBubble = document.createElement('div');
        messageBubble.classList.add('p-3', 'rounded-xl', 'shadow-sm', 'flex-shrink-0'); 

        if (sender === 'user') {
            messageBubble.classList.add('bg-primary', 'text-white', 'ms-auto');
            messageBubble.style.wordWrap = 'break-word';
        } else { 
            messageBubble.classList.add('bg-light', 'text-dark', 'me-auto'); 
            messageBubble.style.wordWrap = 'break-word';
        }
        messageBubble.style.maxWidth = '80%';
        messageBubble.textContent = message;
        
        messageElement.appendChild(messageBubble);
        chatMessagesContainer.appendChild(messageElement);

        chatMessagesContainer.scrollTo({
            top: chatMessagesContainer.scrollHeight,
            behavior: 'smooth'
        });
    }

    async function loadChatHistory() {
        const token = getJwtToken();
        if (!token) {
            chatError.textContent = 'Anda tidak terautentikasi. Silakan login kembali untuk melihat riwayat chat.';
            chatError.style.display = 'block';
            setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
            return;
        }

        try {
            const response = await fetch('/api/chatbot/history', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                }
            });

            const data = await response.json();

            if (response.ok) {
                chatMessagesContainer.innerHTML = ''; 
                if (data.length === 0) {
                     displayMessage('bot', 'Selamat datang di EduBot! AI Agent yang siap membantumu seputar dunia perkuliahan 24/7.');
                } else {
                    data.forEach(chat => {
                        displayMessage(chat.sender, chat.message);
                    });
                }
            } else {
                chatError.textContent = data.error || 'Gagal memuat riwayat chat.';
                chatError.style.display = 'block';
            }
        } catch (error) {
            console.error('Error loading chat history:', error);
            chatError.textContent = 'Terjadi kesalahan jaringan saat memuat riwayat chat.';
            chatError.style.display = 'block';
        }
    }

    async function sendMessage() {
        const message = userInput.value.trim();
        if (message === '') return;

        displayMessage('user', message);
        userInput.value = '';

        chatLoading.style.display = 'block'; 
        chatError.style.display = 'none';
        sendMessageBtn.disabled = true; 

        const token = getJwtToken();
        if (!token) {
            chatError.textContent = 'Sesi Anda berakhir. Silakan login kembali.';
            chatError.style.display = 'block';
            chatLoading.style.display = 'none';
            sendMessageBtn.disabled = false;
            setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
            return;
        }

        try {
            const response = await fetch('/api/chatbot/ask', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();

            if (response.ok) {
                displayMessage('bot', data.reply);
                if (data.needs_personality_test) {
                    const testButtonContainer = document.createElement('div');
                    testButtonContainer.classList.add('text-center', 'mt-3');
                    testButtonContainer.innerHTML = `<a href="{{ route('riasec.test') }}" class="btn btn-info">Mulai Tes RIASEC</a>`;
                    chatMessagesContainer.appendChild(testButtonContainer);
                    chatMessagesContainer.scrollTo({
                        top: chatMessagesContainer.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            } else {
                chatError.textContent = data.reply || data.error || 'Maaf, terjadi kesalahan saat memproses balasan.';
                chatError.style.display = 'block';
            }
        } catch (error) {
            console.error('Error sending message:', error);
            chatError.textContent = 'Terjadi kesalahan jaringan atau server saat mengirim pesan.';
            chatError.style.display = 'block';
        } finally {
            chatLoading.style.display = 'none'; 
            sendMessageBtn.disabled = false; 
            userInput.focus(); 
        }
    }

    sendMessageBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    const token = getJwtToken();
    if (!token) {
        chatError.textContent = 'Anda perlu login untuk menggunakan chatbot.';
        chatError.style.display = 'block';
        setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
    } else {
        loadChatHistory(); 
    }
});
</script>
@endpush

<style>
    #chat-messages .chat-bubble {
        max-width: 80%;
        padding: 10px 15px;
        margin-bottom: 10px;
        border-radius: 20px;
        word-wrap: break-word;
        font-size: 0.9rem;
    }

    #chat-messages .chat-bubble.user {
        background-color: #0d6efd;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 5px;
    }

    #chat-messages .chat-bubble.bot {
        background-color: #e9ecef;
        color: #212529;
        align-self: flex-start;
        border-bottom-left-radius: 5px;
    }

    @media (max-width: 576px) {
        .card-body, #chat-messages .chat-bubble {
            font-size: 0.85rem;
        }
        #send-message-btn i {
            margin: 0;
        }
        .input-group input {
            font-size: 0.9rem;
        }
    }
</style>

