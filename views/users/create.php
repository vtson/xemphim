<p class="form-title"><?php echo LANGUAGE['register'];?></p>
<form action="<?php echo route('users', 'store');?>" method="post">

    <div class="field">
        <label class="label"><?php echo LANGUAGE['username']; ?></label>
        <div class="control has-icons-left has-icons-right">
            <input class="input" type="text" name="username" placeholder="User name">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
        </div>
    </div>

    <div class="field">
        <label class="label"><?php echo LANGUAGE['email']; ?></label>
        <div class="control has-icons-left has-icons-right">
            <input class="input" type="text" name="email" placeholder="@">
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
        </div>
    </div>


    <div class="field">
        <label class="label"><?php echo LANGUAGE['password']; ?></label>
        <div class="control">
            <input class="input" type="password" name="password">
        </div>
    </div>

    <div class="field">
        <label class="label"><?php echo LANGUAGE['re_password']; ?></label>
        <div class="control">
            <input class="input" type="password" name="re_password" />
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="button is-link" type="submit"><?php echo LANGUAGE['register']; ?></button>
        </div>
    </div>
</form>
