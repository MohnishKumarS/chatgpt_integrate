<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>ChatGPT Integration</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="app">
        <div class="container">
            <div>
                <h1 class="title-head">Welcome to ChatBot</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 shadow py-5 px-4">
                    <div class="form-floating">
                        <textarea class="form-control" id="message-input" placeholder="Leave a comment here" style="height: 100px"></textarea>
                        <label for="message-input">Type your message</label>
                    </div>
                    <div id="error-container" class="text-danger"></div>
                  
                    <div class="mt-4 text-center">
                        <button id="send-btn" class="btn-main w-50">Send</button>
                    </div>
                </div>
            </div>

            <div id="chat-box" class="mt-5 shadow p-4">
                <ul id="messages"></ul>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('send-btn').addEventListener('click', async () => {
            const message = document.getElementById('message-input').value;
            if (!message) {
                // Show error message if input is empty
                const errorContainer = document.getElementById('error-container');
                errorContainer.textContent = 'Message cannot be empty!';
                errorContainer.style.color = 'red';

                messageInput.focus();
                return; // Stop execution
            }


            const errorContainer = document.getElementById('error-container');
            errorContainer.textContent = '';
            const response = await fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message
                })
            });
            const data = await response.json();
            const messages = document.getElementById('messages');
            const li = document.createElement('li');
            li.textContent = data.response;
            messages.appendChild(li);


            //         const reader = response.body.getReader();
            // const decoder = new TextDecoder();
            // let done = false;
            // let content = '';

            // while (!done) {
            //     const { value, done: doneReading } = await reader.read();
            //     done = doneReading;
            //     content += decoder.decode(value, { stream: true });
            //     const chunks = content.split('data: ');

            //     for (let chunk of chunks) {
            //         if (chunk.trim()) {
            //             try {
            //                 const json = JSON.parse(chunk);
            //                 // Check for "finish_reason" to detect when the response is complete
            //                 if (json.choices && json.choices[0].delta.content) {
            //                     content += json.choices[0].delta.content;
            //                 }
            //             } catch (error) {
            //                 console.error("Error parsing JSON:", error);
            //             }
            //         }
            //     }
            // }

            //  const messages = document.getElementById('messages');
            //         const li = document.createElement('li');
            //         li.textContent = content;
            //         messages.appendChild(li);
        });
    </script>
</body>

</html>
