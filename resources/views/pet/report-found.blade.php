@extends('layouts.main')

@section('styles')
    <style>
        #reportForm {
            max-width: 500px;
            background-color: #ffffff;
            margin: 40px auto;
            padding: 40px;
            box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
            border-radius: 12px;
        }

        #reportForm .form-header {
            gap: 5px;
            text-align: center;
            font-size: .9em;
        }

        #reportForm .form-header .stepIndicator {
            position: relative;
            flex: 1;
            padding-bottom: 30px;
        }

        #reportForm .form-header .stepIndicator.active {
            font-weight: 600;
        }

        #reportForm .form-header .stepIndicator.finish {
            font-weight: 600;
            color: #009688;
        }

        #reportForm .form-header .stepIndicator::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            z-index: 9;
            width: 20px;
            height: 20px;
            background-color: #d5efed;
            border-radius: 50%;
            border: 3px solid #ecf5f4;
        }

        #reportForm .form-header .stepIndicator.active::before {
            background-color: #a7ede8;
            border: 3px solid #d5f9f6;
        }

        #reportForm .form-header .stepIndicator.finish::before {
            background-color: #009688;
            border: 3px solid #b7e1dd;
        }

        #reportForm .form-header .stepIndicator::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 8px;
            width: 100%;
            height: 3px;
            background-color: #f3f3f3;
        }

        #reportForm .form-header .stepIndicator.active::after {
            background-color: #a7ede8;
        }

        #reportForm .form-header .stepIndicator.finish::after {
            background-color: #009688;
        }

        #reportForm .form-header .stepIndicator:last-child:after {
            display: none;
        }

        #reportForm input {
            padding: 15px 20px;
            width: 100%;
            font-size: 1em;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
        }

        #reportForm input:focus {
            border: 1px solid #009688;
            outline: 0;
        }

        #reportForm input.invalid {
            border: 1px solid #ffaba5;
        }

        #reportForm .step {
            display: none;
        }

        #reportForm .form-footer {
            overflow: auto;
            gap: 20px;
        }

        #reportForm .form-footer button {
            background-color: #009688;
            border: 1px solid #009688 !important;
            color: #ffffff;
            border: none;
            padding: 13px 30px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            flex: 1;
            margin-top: 5px;
        }

        #reportForm .form-footer button:hover {
            opacity: 0.8;
        }

        #reportForm .form-footer #prevBtn {
            background-color: #fff;
            color: #009688;
        }
    </style>
@endsection

@section('content')
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row">
            <form id="reportForm" action="{{ route('pet.report.found.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- start step indicators -->
                <div class="form-header d-flex mb-4">
                    <span class="stepIndicator">Describe la mascota</span>
                    <span class="stepIndicator">Sube una imagen</span>
                    <span class="stepIndicator">Datos de contacto</span>
                </div>
                <!-- end step indicators -->

                <!-- step one -->
                <div class="step">
                    <p class="text-center mb-4">Describe la mascota</p>
                    <div class="mb-3">
                        <input type="text" placeholder="Descríbela" oninput="this.className = ''" name="description">
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="¿Donde la encontraste?" oninput="this.className = ''"
                            name="last_location">
                    </div>
                    <div class="mb-3">
                        <label for="">¿Esta resguardada?</label>
                        <input type="checkbox" name="is_protected" oninput="this.className = ''">
                    </div>
                </div>

                <!-- step two -->
                <div class="step">
                    <p class="text-center mb-4">Sube una imagen</p>
                    <div class="mb-3 text-center">
                        <input accept="image/*" id="petImage" type="file" oninput="this.className = ''" name="picture">
                        <img class="mt-2" id="petPreview" src="#" alt="Pet Image Preview" style="width: 300px;"
                            crossorigin='anonymous' />
                        <input id="species" type="hidden" name="species" value="" oninput="this.className = ''">
                    </div>
                </div>

                <!-- step three -->
                <div class="step">
                    <p class="text-center mb-4">Datos de contacto</p>
                    <div class="mb-3">
                        <input type="text" placeholder="Nombre completo" oninput="this.className = ''" name="fullname">
                    </div>
                    <div class="mb-3">
                        <input type="text" placeholder="N* Celular" oninput="this.className = ''" name="mobile">
                    </div>
                    <div class="mb-3">
                        <input type="email" placeholder="E-mail" oninput="this.className = ''" name="email">
                    </div>
                </div>

                <!-- start previous / next buttons -->
                <div class="form-footer d-flex">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                </div>
                <!-- end previous / next buttons -->
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.roboflow.com/0.2.26/roboflow.js"></script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("step");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Enviar";
            } else {
                document.getElementById("nextBtn").innerHTML = "Siguiente";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("step");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("reportForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("step");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("stepIndicator");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }

        var imgInp = document.getElementById('petImage');
        var imgPrv = document.getElementById('petPreview');

        imgInp.onchange = function() {
            const f = imgInp.files[0];
            if (f) {
                imgPrv.src = URL.createObjectURL(f);

                // fetch information
                async function getModel() {
                    var model = await roboflow
                        .auth({
                            publishable_key: "{{ config('services.roboflow.public_key') }}",
                        })
                        .load({
                            model: 'oxford-pets', //'dog-and-cat-face-detection:1',
                            version: 3, //1,
                        });

                    return model;
                }

                let initialized_model = getModel();

                initialized_model.then(function(model) {
                    let img = document.getElementById('petPreview');
                    model.detect(img).then(function(predictions) {
                        console.log("Predictions: ", predictions);
                        let prediction = predictions[0];
                        console.log(prediction);

                        let speciesInput = document.getElementById('species');
                        speciesInput.value = prediction.class;
                    });
                });
            }
        }
    </script>
@endsection
