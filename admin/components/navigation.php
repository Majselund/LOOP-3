<?php if (isset($user)) : ?>
    <nav>
        <div class="container mx-auto navigation">
            <div>
                <a href="/index.php">Innovations<strong>dag</strong></a>
            </div>
            <div>
                <a href="/admin/index.php">Home</a> | <a href="/admin/components/create_user.php">Opret bruger</a> | <a href="/admin/components/logout.php">Log ud</a>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav>
        <div class="container mx-auto navigation">
            <div>
                <a href="/index.php">Innovations<strong>dag</strong></a>
            </div>
            <div>
                <a href="/admin/index.php">Home</a> | <a href="/admin/components/login.php">Login</a>
            </div>
        </div>
    </nav>
<?php endif; ?>