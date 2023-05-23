<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome to JS class</h1>

    <script>
        'use strict';

        let myProm1 = new Promise(async function(resolve, reject) {
            // try {
            //     let res = await fetch('/promise1');
            //     resolve(res);
            // } catch(err) {
            //     reject(err);
            // }
            // setInterval(function () {
            //     console.log('done')
            // }, 10000)
            // for (let i = 0; i < 1000000000; i++) {
            //     100000000*22/23;
            // }
            // console.log("damn");

            // setInterval(function() {
            //     for (let i = 0; i < 1000000000; i++) {
            //         100000000 * 22 / 23;
            //     }
            //     console.log("damn");
            // }, 0)
        })

        let myProm2 = new Promise(async function(resolve, reject) {
            resolve('done 2');
        })

        myProm1.then(res => console.log(res)).catch(err => console.log(err));
        myProm2.then(res => console.log(res)).catch(err => console.log(err));
    </script>
</body>

</html>