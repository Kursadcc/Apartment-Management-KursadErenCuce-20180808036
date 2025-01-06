<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">
                <img class="mb-2" src="../img/kccproperty.png" width="32" height="40" /> &nbsp;KCC Property
            </span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                <i class="align-middle" data-feather="book"></i> <span class="align-middle">Main Pages</span>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "[Settings].[IncomeTypeManagement]" ? "active" : ""); ?>"></li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "AnnouncementManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Announcements/AnnouncementManagement.php">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Announcements</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "IncomeManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Incomes/IncomeManagement.php">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Incomes</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "ExpenseManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Expenses/ExpenseManagement.php">
                    <i class="align-middle" data-feather="trending-down"></i> <span class="align-middle">Expenses</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "Balance" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Balance/Balance.php">
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Balance</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "FlatDueManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../FlatDues/FlatDueManagement.php">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Flat Dues</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "ResidentManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Residents/ResidentManagement.php">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Residents</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "MovedOutResident" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Residents/MovedOutResident.php">
                    <i class="align-middle" data-feather="user-x"></i> <span class="align-middle">Moved-out Residents</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "Answer" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../MessageAnswers/Answer.php">
                    <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Messages</span>
                </a>
            </li>

            <li class="sidebar-header">
                <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "IncomeTypeManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Settings/IncomeTypeManagement.php">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Income Types</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "ExpenseTypeManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Settings/ExpenseTypeManagement.php">
                    <i class="align-middle" data-feather="trending-down"></i> <span class="align-middle">Expense Types</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "FlatManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Settings/FlatManagement.php">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Flats</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "DueManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Dues/DueManagement.php">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Add Due</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "MessageTypeManagement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Settings/MessageTypeManagement.php">
                    <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Message Types</span>
                </a>
            </li>

        </ul>
    </div>
</nav>