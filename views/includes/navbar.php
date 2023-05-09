<div class="nav">
    <div class="left-side">
        <a href="/"><span class="logo">A3</span></a>
    </div>
    <div class="right-side">
        <?php if(isset($_SESSION['user_id'])): ?>
            <div class="nav-right-items"><a href="/dashboard"><button class="nav-btn">Dashboard</button></a></div>
            <div class="nav-right-items"><a href="/logout"><button class="nav-btn">Logout</button></a></div>
        <?php else: ?>
            <div class="nav-right-items"><a href="/login"><button class="nav-btn">Login</button></a></div>
            <div class="nav-right-items"><a href="/register"><button class="nav-btn">Register</button></a></div>
        <?php endif; ?>
        
    </div>
</div>