<div class="admin-container">
    <div class="left-menu">
        <div class="user-profile">
            <div class="user-img">
                <img src="/Assets/Admin/user.png" alt="user">
            </div>
            <div class="user-info">
                <h3>Admin</h3>
                <p>Online</p>
            </div>
        </div>
        <div class="general">
            <h1>General</h1>
        </div>
        <div class="menu-container">
            <ul>
                <li><a href="/admin/dashboard">Dashboard</a></li>
                <li><a href="/admin/users">Users</a></li>
                <li><a href="/admin/products">Products</a></li>
            </ul>
        </div>
    </div>
    <div class="products-container">
        <div class="container">
            <div class="header">
                <div>
                    <h1>Products</h1>
                    <p>30 products found</p>
                </div>
                <button>Add Product</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>img</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($model['products'] as $product) { ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><img class="product-img" src="/Assets/dummy-product.png" alt=""></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['category_name'] ?></td>
                        <td>
                            <button class="edit-button">Edit</button>
                            <button onclick="window.location.href='/delete?id=<?= $product['id'] ?>'" class="delete-button">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>