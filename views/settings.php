<div id="container">
    <div id="box">
        <h1 id="title">Botastico Script Inserter</h1>
        <form id="form" method="post">
            <label for="app_id"></label>
            <input type="text" id="app_id" name="app_id" value="<?php echo esc_attr($current_app_id); ?>" placeholder="enter your app id..." required/>
            <input type="submit" id="submit_button" name="submit" value="save" />
        </form>
    </div>
</div>