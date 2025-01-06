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
            <li class="sidebar-item <?php echo ($selectedMenuName == "Announcement" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Announcements/Announcement.php">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Announcements</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "Income" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Incomes/Income.php">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Incomes</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "Expense" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Expenses/Expense.php">
                    <i class="align-middle" data-feather="trending-down"></i> <span class="align-middle">Expenses</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "Balance" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Balance/Balance.php">
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Balance</span>
                </a>
            </li>

            <li class="sidebar-item <?php echo ($selectedMenuName == "FlatDue" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../FlatDues/FlatDue.php">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Flat Dues</span>
                </a>
            </li>


            <li class="sidebar-item <?php echo ($selectedMenuName == "Resident" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Residents/Resident.php">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Residents</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "MovedOutResident" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../Residents/MovedOutResident.php">
                    <i class="align-middle" data-feather="user-x"></i> <span class="align-middle">Moved-out Residents</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo ($selectedMenuName == "ResidentMessage" ? "active" : ""); ?>">
                <a class="sidebar-link" href="../ResidentMessages/ResidentMessage.php">
                    <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Messages</span>
                </a>
            </li>
        </ul>
    </div>
</nav>