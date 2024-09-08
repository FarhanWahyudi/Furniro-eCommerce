<div class="container">
    <h1>Create Product</h1>
    <p>Add a new product on the system</p>
    <form action="">
        <div class="form">
            <label for="name">Name</label>
            <input id="name" type="text">
        </div>
        <div class="form">
            <label for="desc">Desc</label>
            <textarea id="desc" rows="10"></textarea>
        </div>
        <div class="form">
            <label for="price">Price</label>
            <input id="price" type="text">
        </div>
        <div class="form">
            <label for="dicount">Dicount Price</label>
            <input id="dicount" type="text">
        </div>
        <div class="form">
            <label for="category">Category</label>
            <input id="category" type="text">
        </div>
        <div class="form">
            <label for="img">Img</label>
            <input id="img" type="text">
        </div>
        <div class="action-container">
            <button class="cancel-button" type="button" onclick="window.location.href='/admin/products'">Cancel</button>
            <button class="create-button" type="submit">Create</button>
        </div>
    </form>
</div>