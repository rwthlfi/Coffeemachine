<head>
    <h1>
        ADD PRODUCT !
    </h1>
    <form method="post" action="add_product_process.php">
        Name: <input type="text" id="name" name="name"> <br>
        Price: <input type="number" step="any" id="price" name="price"> <br>
        <input type="submit" value="finish">
    </form>

    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>

    <button onclick="navigateTo('admin_welcome.php')">home</button>

</head>