@extends('layouts.app')

@section('title', 'Vibe Assistant')

@push('head')
    <style>
        .chat-card {
            max-width: 860px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            height: calc(100vh - 190px);
            min-height: 520px;
        }

        .chat-top {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 24px;
            border-bottom: 1px solid var(--line);
        }

        .chat-mark {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--purple), #9b7bff);
            display: grid;
            place-items: center;
            color: #fff;
            font-weight: 800;
            font-size: 17px;
        }

        .chat-top h2 { margin: 0; font-size: 16px; font-weight: 700; }
        .chat-top small { color: var(--muted); font-size: 13px; }

        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .hello { margin: auto; text-align: center; max-width: 460px; }
        .hello h3 { font-size: 26px; font-weight: 700; letter-spacing: -.6px; margin: 0 0 8px; }
        .hello p { color: var(--muted); margin: 0 0 22px; }

        .chips { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }

        .chip {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 8px 15px;
            font: inherit;
            font-size: 13px;
            color: var(--ink);
            cursor: pointer;
            transition: .15s;
        }

        .chip:hover { border-color: var(--purple); color: var(--purple); background: var(--purple-soft); }

        .msg {
            max-width: 76%;
            padding: 11px 15px;
            border-radius: 14px;
            font-size: 14.5px;
            line-height: 1.55;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .msg.me { align-self: flex-end; background: var(--purple); color: #fff; border-bottom-right-radius: 4px; }
        .msg.bot { align-self: flex-start; background: #f2f3f9; color: var(--ink); border-bottom-left-radius: 4px; }
        .msg.warn { align-self: flex-start; background: var(--red-soft); color: #b42318; border-bottom-left-radius: 4px; }

        .chat-foot { padding: 16px 24px; border-top: 1px solid var(--line); }

        .composer { display: flex; gap: 10px; align-items: center; }

        .composer input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: 999px;
            font: inherit;
            font-size: 14.5px;
        }

        .composer input:focus {
            outline: none;
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(109, 93, 252, .14);
        }

        .send {
            width: 42px;
            height: 42px;
            flex: none;
            border: 0;
            border-radius: 50%;
            background: var(--purple);
            color: #fff;
            font-size: 19px;
            cursor: pointer;
            display: grid;
            place-items: center;
        }

        .send:hover { background: var(--purple-dark); }
        .send:disabled { opacity: .5; cursor: not-allowed; }
    </style>
@endpush

@section('content')
    @php($isAdmin = (auth()->user()->role ?? 'user') === 'admin')

    <section class="card chat-card">
        <div class="chat-top">
            <div class="chat-mark">A</div>
            <div>
                <h2>Vibe Assistant</h2>
                <small>{{ $isAdmin ? 'Admin workspace assistant' : 'Shopper assistant' }}</small>
            </div>
        </div>

        <div class="chat-body" id="chatBody">
            <div class="hello" id="hello">
                <h3>How can I help you?</h3>
                <p>Ask about products, your cart, or the tools available to your account.</p>
                <div class="chips">
                    <button class="chip">Show me the available products</button>
                    <button class="chip">Help me with my cart</button>
                    <button class="chip">What can I do as a user?</button>
                    <button class="chip">What can an admin do?</button>
                </div>
            </div>
        </div>

        <div class="chat-foot">
            <form class="composer" id="chatForm">
                <input type="text" id="userInput" placeholder="Message Vibe Assistant..." autocomplete="off" required>
                <button type="submit" class="send" id="sendBtn" aria-label="Send">&rarr;</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('chatForm');
        const input = document.getElementById('userInput');
        const body = document.getElementById('chatBody');
        const hello = document.getElementById('hello');
        const sendBtn = document.getElementById('sendBtn');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function add(text, kind) {
            if (hello && hello.parentNode) hello.remove();
            const el = document.createElement('div');
            el.className = 'msg ' + kind;
            el.textContent = text;
            body.appendChild(el);
            body.scrollTop = body.scrollHeight;
            return el;
        }

        document.querySelectorAll('.chip').forEach(function (chip) {
            chip.addEventListener('click', function () {
                input.value = chip.textContent.trim();
                form.requestSubmit();
            });
        });

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            add(message, 'me');
            input.value = '';
            sendBtn.disabled = true;
            const pending = add('Thinking...', 'bot');

            try {
                const res = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                });

                const data = await res.json();
                pending.remove();

                if (data.reply) {
                    add(data.reply, 'bot');
                } else {
                    add(data.error || 'Something went wrong, please try again.', 'warn');
                }
            } catch (err) {
                pending.remove();
                add('Could not reach the assistant. Please try again.', 'warn');
            } finally {
                sendBtn.disabled = false;
                input.focus();
            }
        });
    </script>
@endpush
