<?php ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let page = new URLSearchParams(window.location.search).get("page");
        if (page === "stock") {
            document.getElementById("stock").classList.add("active");
        } else if (page === "products") {
            document.getElementById("products").classList.add("active");
        } else if (page === "categories") {
            document.getElementById("categories").classList.add("active");
        }
    });
</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" id="stock" href="?page=stock"> Estoque </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="products" href="?page=products">Produtos </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="categories" href="?page=categories">Categorias </a>
            </li>
        </ul>
    </div>
</nav>
