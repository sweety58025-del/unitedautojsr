<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <h3>Student Form</h3>

        <!-- Name -->
        <div class="row">
            <div class="col-md-6">
                <label>Name (English)</label>
                <input type="text"
                    name="name_en"
                    class="form-control eng-input"
                    data-target="name_hi">
            </div>

            <div class="col-md-6">
                <label>Name (Hindi)</label>
                <input type="text"
                    id="name_hi"
                    name="name_hi"
                    class="form-control">
            </div>
        </div>


        <!-- Father Name -->
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Father Name (English)</label>
                <input type="text"
                    name="father_name_en"
                    class="form-control eng-input"
                    data-target="father_name_hi">
            </div>

            <div class="col-md-6">
                <label>Father Name (Hindi)</label>
                <input type="text"
                    id="father_name_hi"
                    name="father_name_hi"
                    class="form-control">
            </div>
        </div>


        <!-- Mother Name -->
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Mother Name (English)</label>
                <input type="text"
                    name="mother_name_en"
                    class="form-control eng-input"
                    data-target="mother_name_hi">
            </div>

            <div class="col-md-6">
                <label>Mother Name (Hindi)</label>
                <input type="text"
                    id="mother_name_hi"
                    name="mother_name_hi"
                    class="form-control">
            </div>
        </div>


        <!-- Address -->
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Address (English)</label>
                <input type="text"
                    name="address_en"
                    class="form-control eng-input"
                    data-target="address_hi">
            </div>

            <div class="col-md-6">
                <label>Address (Hindi)</label>
                <input type="text"
                    id="address_hi"
                    name="address_hi"
                    class="form-control">
            </div>
        </div>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {

        const englishInputs = document.querySelectorAll(".eng-input");

        englishInputs.forEach(function (input) {

            input.addEventListener("input", function () {

                const targetId = this.getAttribute("data-target");
                const hindiInput = document.getElementById(targetId);

                if (!hindiInput) return;

                const text = this.value;

                if(text.length === 0){
                    hindiInput.value = "";
                    return;
                }

                fetch(`https://inputtools.google.com/request?text=${text}&itc=hi-t-i0-und&num=1`)
                .then(response => response.json())
                .then(data => {

                    if(data[0] === "SUCCESS"){

                        hindiInput.value = data[1][0][1][0];

                    }

                })
                .catch(error => console.log(error));

            });

        });

    });
    </script>

</body>
</html>