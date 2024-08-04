<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!--<img id="pet" src="https://cdn.pixabay.com/photo/2024/02/28/07/42/european-shorthair-8601492_1280.jpg" crossorigin='anonymous'> -->
    {{-- <img id="pet" src="https://cdn.pixabay.com/photo/2019/02/23/15/31/cats-4015834_960_720.jpg"
        crossorigin='anonymous'> --}}
    <img id="pet" src="https://cdn.pixabay.com/photo/2019/02/23/15/31/cats-4015832_1280.jpg" style="width: 300px;"
        crossorigin='anonymous'>

    <div id="summary"></div>

    <!--
            dog-and-cat-face-detection
        class: Cat
        confidence: 0.8764678239822388
        color: "#4892EA"

            oxford-pets
        class: Cat russian blue
        confidence: 0.7016808390617371
        color: "#4892EA"

        class: "cat-Abyssinian"
        confidence: 0.6263236999511719
        color: "#4892EA"

        class: "cat-Abyssinian"
        confidence: 0.7848436832427979
        color: "#4892EA"
        -->

    <script src="https://cdn.roboflow.com/0.2.26/roboflow.js"></script>
    <script>
        async function getModel() {
            var model = await roboflow
                .auth({
                    publishable_key: 'rf_lBBC6zDximV8zV5zOQwY3USeQy72',
                })
                .load({
                    model: 'oxford-pets', //'dog-and-cat-face-detection',
                    version: 3, //1,
                });

            return model;
        }

        var initialized_model = getModel();

        initialized_model.then(function(model) {
            var img = document.getElementById('pet');
            model.detect(img).then(function(predictions) {
                console.log("Predictions: ", predictions);
                var div = document.getElementById('summary');
                div.innerHTML = JSON.stringify(predictions[0]);
            });
        });
    </script>
</body>

</html>
