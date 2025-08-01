<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service | Company Name</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <div class="container header-container">
            <div class="logo">Company Name</div>
            <nav>
                <ul>
                    <li><a href="../services/list.html">Services</a></li>
                    <li><a href="../services/add.html">Add Service</a></li>
                    <li><a href="../auth/signup.html">Sign Up</a></li>
                    <li><a href="../auth/login.html">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <section>
            <h2>Add New Service</h2>
            <div class="form-container">
                <form id="service-form">
                    <div class="form-group">
                        <label for="service-name">Service Name</label>
                        <input type="text" id="service-name" name="service-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="service-description">Description</label>
                        <textarea id="service-description" name="service-description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="service-price">Price ($)</label>
                        <input type="number" id="service-price" name="service-price" min="0" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="service-category">Category</label>
                        <select id="service-category" name="service-category" required>
                            <option value="">Select a category</option>
                            <option value="IT Services">IT Services</option>
                            <option value="Design">Design</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Consulting">Consulting</option>
                        </select>
                    </div>
                    
                    <button type="submit">Add Service</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 Company Name. All rights reserved.</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>