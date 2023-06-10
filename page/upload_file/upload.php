<div class="container">
    <form method ="POST" action="../../function/upload_file/upload.php" enctype="multipart/form-data">
        <label for="upfile">ファイルパス：</label>
        <input type="hidden" name="max_file_size" value="1000000">
        <input id="upload" type="file" name="upfile" size="40">
        <input type="submit" value="アップロード">
    </form>
</div>

