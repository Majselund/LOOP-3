<?php if (isset($user)) : ?>
    <nav>
        <div class="container mx-auto navigation">
            <div>
                <a href="/index.php">Innovations<strong>dage</strong></a>
            </div>
            <div>
                <a href="/admin/index.php">Home</a> | <a href="/admin/create_user.php">Opret bruger</a> | <a href="/admin/edit_home.php">Rediger side</a> | <a href="/admin/participators.php">Vis tilmeldte</a> | <a href="/admin/includes/logout.php">Log ud</a>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav>
        <div class="container mx-auto navigation">
            <div>
                <a href="/index.php">Innovations<strong>dage</strong></a>
            </div>
            <div>
                <a href="/admin/index.php">Home</a> | <a href="/admin/login.php">Login</a>
            </div>
        </div>
    </nav>
<?php endif; ?>