<div class="container">
    <div wire:loading wire:target="sendMessage">Sending...</div>

    <div class="emojiPopup" id="emojiPopup">
        <div class="emojiSelector">
            <span class="emoji" onclick="selectEmoji('😊')">😊</span>
            <span class="emoji" onclick="selectEmoji('😂')">😂</span>
            <span class="emoji" onclick="selectEmoji('🎉')">🎉</span>
            <span class="emoji" onclick="selectEmoji('❤️')">❤️</span>
            <span class="emoji" onclick="selectEmoji('😘')">😘</span>
            <span class="emoji" onclick="selectEmoji('😒')">😒</span>
            <span class="emoji" onclick="selectEmoji('😍')">😍</span>
            <span class="emoji" onclick="selectEmoji('🙌')">🙌</span>
        </div>
    </div>
    <div class="emojiPopup" id="emojiPopup_"></div>

    <div class="chatBody">
        @foreach ($messages as $message)
            <div>{!! $message !!}</div>
        @endforeach
    </div>
    <style>
        .chatBody {
            overflow-y: auto;
            word-wrap: break-word;
            min-width: 100vw;
            color: white;
            min-height: 20vh;
            max-height: 20vh;
            position: absolute;
            bottom: 100px;
            left: 0px;
            z-index: 100;
            font-size: 2vh;
        }

        .footer-chat {
            box-sizing: border-box;
            z-index: 100;
            background: linear-gradient(to bottom, #0e324c, #001a2d);
            min-width: 100vw;
            position: absolute;
            bottom: 3vh !important;
            height: 6vh !important;
            left: -6px !important;
        }

        .search-bar {
            box-sizing: border-box;
            display: grid;
            grid-template-columns: 5fr 1fr;

            z-index: 100;
            padding: 0.5vh;
        }

        .search-bar input,
        .search-bar button {
            box-sizing: border-box;
            height: 4vh !important;
            margin: 5px;
            font-size: 2vh;
            border-radius: 5vw !important;
        }

        .search-bar input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc !important;
        }

        .search-bar button {
            border: none !important;
            color: #fff !important;
            cursor: pointer !important;
        }

        @media only screen and (max-width: 1000px) {
            .chatBody {
                min-height: 20vh;
                max-height: 20vh;
                bottom: 7vh;
            }
            
            .search-bar {
                grid-template-columns: 3fr 1fr;
            }

            .footer-chat {
                bottom: 6vh !important;
                height: 6vh !important;
            }
        }
        .blue {
            color: blue;
        }
        .lp {
            padding-left: 10px;
        }
    </style>
    <div class="footer-chat">
        <div class="search-bar">
            <input wire:model="newMessage" type="text" placeholder="Enter your msg...">
            <div>
                <button class="button_" wire:click="sendMessage">Send</button>
                <button style="font-size: 3vh; background-color: transparent;">|</button>
                <button class="button_ button_w" id="emojiButton"><i class="far fa-smile"></i></button>
            </div>
        </div>
    </div>
    <script>
        function selectEmoji(selectedEmoji) {
            closeEmoji();
            const emojiPopup = document.getElementById('emojiPopup_');
            emojiPopup.innerHTML = `<span>${selectedEmoji}</span>`;
            emojiPopup.style.display = 'block';

            setTimeout(function() {
                emojiPopup.style.display = 'none';
            }, 1000);
        }
        document.getElementById('emojiButton').addEventListener('click', function() {
            document.getElementById('emojiPopup').style.display = 'block';
        });

        function closeEmoji() {
            document.getElementById('emojiPopup').style.display = 'none';
        }
    </script>
</div>
