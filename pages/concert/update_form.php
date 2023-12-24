<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) {?>
              <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
            <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Concert <br> EDIT</h2>
    <a class="pl-3" href="<?php echo Path::ROOT . 'concert' ?>">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="<?php echo Path::ROOT . 'concert/update'; ?>">
            <?php foreach ($concerts as $concert){?>
                <div class="flex-box justify-center my-2">
                  <input hidden name="id" value="<?php echo h($concert["id"]);?>">
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="name"  class="label">name</label>
                    <input 
                        name="name" 
                        class="form-input" 
                        placeholder="名前を入力"
                        value="<?php if($old){
                            echo h($old['name']);
                        }else{
                            echo h($concert["name"]);
                        }?>"
                    />
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="date"  class="label">date</label>
                    <input 
                        type="text" 
                        name="date" 
                        class="form-input" 
                        value="<?php if($old){
                            echo h($old['date']);
                        }else{
                            echo h($concert["date"]);
                        }?>"
                    />
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="place" class="label">place</label>
                    <input 
                        type="text" 
                        name="place" 
                        class="form-input" 
                        value="<?php if($old){
                            echo h($old['place']);
                        }else{
                            echo h($concert["place"]);
                        }?>"
                    />
                </div>
            <?php } ?>
            <div class="flex-box justify-center py-2">
                <button type="submit" class="button primary">EDIT</button>
            </div>    
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php'); ?>
