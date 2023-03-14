<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Bot</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>
    #response::-webkit-scrollbar {
        width: 6px;
        /* width of the scrollbar */
    }

    #response::-webkit-scrollbar-thumb {
        background-color: #ccc;
        /* color of the scrollbar thumb */
        border-radius: 6px;
        /* rounded corners of the thumb */
    }

    #response::-webkit-scrollbar-track {
        background-color: #f2f2f2;
        /* color of the scrollbar track */
    }
</style>

<body>

    <!-- Navbar -->
<div class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary shadow-sm">
        <a class="navbar-brand text-white fs-3" href="#"> Chatbot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
</div>



    <div class="container h-100 pt-5">
        <div class="row" style="height:100%;">
            <div class="row  "  style="margin-bottom:140px;">
                <div class="mb-3 d-none" style="" id="response"></div>
                {{-- <div id="query" class="mb-3"></div>
            <div id="response"></div> --}}
            </div>
        </div>
    </div>
    <div class="section-form bg-secondary" style=" position: fixed; bottom: 0; width: 100%;">
        <div class="card bg-secondary" style="">
            <div class="card-body">
                <form id="form">
                    {{-- <label for="">Enter Query</label> --}}
                    <div class="mb-3 input-group">
                        <textarea type="text" class="form-control shadow-sm" id="prompt" name="prompt" style="height:60px;resize: none;" placeholder="Type Here...."></textarea>
                        <button type="submit" id="submit_btn" value="Enter" class="btn btn-light"><i
                                class="fa-duotone fa-magnifying-glass"></i></button>
                    </div>
                    <div class="mb-3"></div>
                </form>
            </div>
        </div>
    </div>


</body>
<!-- jQuery version 3.x -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (required) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {



        $('textarea').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        const responseElement = document.getElementById('response');

        const form = document.getElementById('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const promptElement = document.getElementById('prompt');
            const promptValue = document.getElementById('prompt').value;
            console.log(promptElement)
            promptElement.classList.remove('is-invalid');

            if (promptValue == '') {
                promptElement.classList.add('is-invalid');
            } else {

                innerText = promptValue;
                responseElement.classList.remove('d-none');

                responseElement.innerHTML +=
                    '<div id="query" class="mb-1 "> Q :: ' +
                    promptValue + '</div>';
                promptElement.value = '';
                const data = {
                    _token: '{{ csrf_token() }}',
                    prompt: promptValue
                }

                fetch('{{ route('prompt.search') }}', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).then(function(response) {
                    return response.json()
                }).then(function(result) {

                    var i = 0;
                    var txt = result; /* The text */
                    var speed = 20; /* The speed/duration of the effect in milliseconds */

                        responseElement.innerHTML +=
                        ' <div class="bg-light px-4 mb-3 " style="white-space: pre-wrap; text-indent: 0;"></div> ';




                    var i = 0;
                    var txt = result; /* The text */
                    var speed = 1; /* The speed/duration of the effect in milliseconds */

                    function typeWriter() {
                        if (i < txt.length) {
                            var currentText = responseElement.lastElementChild;
                            currentText.textContent += txt.charAt(i);
                            i++;
                            setTimeout(typeWriter, speed);
                        }
                    }

                    setTimeout(typeWriter,
                        1000); // Delay the typing for 1 second after the prompt is displayed

                    //  = result;
                    console.log(result);
                }).catch(error => {
                    // Handle error
                    console.error('Error:', error);
                });
            }
        })

        const textarea = document.getElementById("prompt");

        // Add event listener for keydown
        textarea.addEventListener("keydown", function(e) {
            // Check if Enter key was pressed


            if (event.key === "Enter") {
                e.preventDefault();

                const submit = document.getElementById('submit_btn');

                submit.click();
            }
        })
    })
</script>

</html>
