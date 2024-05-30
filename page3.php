<?php
    include_once('partials/header.php');
?>    
    <main>
    <div class="parallax bg14 w80">
        <form action="" class="form" id="add-form">
            <div class="input-box">
                <input data-required="true" type="text" class="input-field" placeholder="Meno">
            </div>
            <div class="input-box">
                <input data-required="true" type="email" class="input-field" placeholder="Email">
            </div>
            <div class="input-box">
                <textarea></textarea>
            </div>
                <span>Súhlas so spracovaním osobných údajov
                    <input type="checkbox" name="check" id="check">
                </span>
                
            <button type="submit" class="send-btn">Send</button>
        </form>
    </div>
    </main>
    <?php
    include_once('partials/footer.php');
    ?>
</body>
<script src="js/main.js"></script>
<script src="js/form.js"></script>
</html>