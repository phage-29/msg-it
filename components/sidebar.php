<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Core</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="profile.php">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-heading">Forms</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="zoomrequest.php">
                <i class="bi bi-camera-video"></i>
                <span>Zoom Request</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="assistance.php">
                <i class="bi bi-tools"></i>
                <span>ICT Request</span>
            </a>
        </li>

        <li class="nav-heading">Pages</li>

        <?php
        switch ($_SESSION['Role']) {
            case 'Employee':
        ?>
                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="ictrequestform.php">
                        <i class="bi bi-input-cursor-text"></i>
                        <span>Request Form</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="ictrequests.php">
                        <i class="bi bi-card-list"></i>
                        <span>My Requests</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="ictrequests.php">
                        <i class="bi bi-calendar"></i>
                        <span>My Meetings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed logout" href="#">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php
                break;

            case 'Staff':
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed logout" href="#">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php
                break;

            case 'Officer':
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed logout" href="#">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php
                break;

            case 'Admin':
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed logout" href="#">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php
                break;

            default:
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed logout" href="#">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
        <?php
                break;
        }
        ?>

    </ul>

</aside><!-- End Sidebar-->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current URL
        var currentURL = window.location.href.split('/');
        currentURL = currentURL[currentURL.length - 1].split('?');
        currentURL = currentURL[0];

        // Get all anchor elements in the navigation
        var navLinks = document.querySelectorAll('.nav-link');

        // Loop through each anchor element
        navLinks.forEach(function(link) {
            // Check if the href attribute matches the current URL
            if (link.getAttribute('href') === currentURL) {
                // Remove "collapsed" class and add "active" class
                link.classList.remove('collapsed');
                link.classList.add('active');
            }

        });
    });
</script>