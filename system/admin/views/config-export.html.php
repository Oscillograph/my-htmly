<?php namespace myHTMLy; if (!defined('HTMLY')) die('HTMLy'); ?>
<h2><?php echo i18n('Writing_Settings');?></h2>
<br>
<nav>
  <div class="nav nav-tabs" id="nav-tab">
    <a class="nav-item nav-link" id="nav-general-tab" href="<?php echo site_url();?>admin/config"><?php echo i18n('General');?></a>
    <a class="nav-item nav-link" id="nav-profile-tab" href="<?php echo site_url();?>admin/config/reading"><?php echo i18n('Reading');?></a>
    <a class="nav-item nav-link" id="nav-writing-tab" href="<?php echo site_url();?>admin/config/writing"><?php echo i18n('Writing');?></a>
    <a class="nav-item nav-link active" id="nav-export-tab" href="<?php echo site_url();?>admin/config/export"><?php echo i18n('Export');?></a>
    <a class="nav-item nav-link" id="nav-widget-tab" href="<?php echo site_url();?>admin/config/widget"><?php echo i18n('Widget');?></a>
    <a class="nav-item nav-link" id="nav-metatags-tab" href="<?php echo site_url();?>admin/config/metatags"><?php echo i18n('Metatags');?></a>
    <a class="nav-item nav-link" id="nav-security-tab" href="<?php echo site_url();?>admin/config/security"><?php echo i18n('Security');?></a>
    <a class="nav-item nav-link" id="nav-performance-tab" href="<?php echo site_url();?>admin/config/performance"><?php echo i18n('Performance');?></a>
    <a class="nav-item nav-link" id="nav-custom-tab" href="<?php echo site_url();?>admin/config/custom"><?php echo i18n('Custom');?></a>
  </div>
</nav>
<br><br>
<form method="POST">
  <input type="hidden" name="csrf_token" value="<?php echo get_csrf(); ?>">
  <!-- Export news to PhpBB -->
  <h4>PhpBB</h4>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><?php echo i18n('Enable_export_phpbb');?></label>
    <div class="col-sm-10">
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="-config-export.phpbb.enable" id="export-phpbb.enable1" value="true" <?php if (config('export.phpbb.enable') === 'true'):?>checked<?php endif;?> onChange="javascript: document.getElementById('export-phpbb-settings').setAttribute('class', '');">
          <label class="form-check-label" for="export-phpbb.enable1">
            <?php echo i18n('Enable');?>
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="-config-export.phpbb.enable" id="export-phpbb.enable2" value="false" <?php if (config('export.phpbb.enable') === 'false'):?>checked<?php endif;?> onChange="javascript: document.getElementById('export-phpbb-settings').setAttribute('class', 'disabled');">
          <label class="form-check-label" for="export-phpbb.enable2">
            <?php echo i18n('Disable');?>
          </label>
        </div>
      </div>
      <small><em><?php echo i18n('Explain_export_phpbb');?></em></small>
    </div>
  </div>
  <div class="<?php if (config('export.phpbb.enable') === 'false'):?>disabled<?php endif;?>" id="export-phpbb-settings">
    <div class="form-group row">
      <label for="export-phpbb-server-path" class="col-sm-2 col-form-label"><?php echo i18n('Export_phpbb_server_path');?></label>
      <div class="col-sm-10">
        <input type="text" name="-config-export.phpbb.serverpath" class="form-control" id="export-phpbb-server-path" value="<?php echo config('export.phpbb.serverpath');?>" placeholder="<?php echo i18n('Export_phpbb_server_path');?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="export-phpbb-url" class="col-sm-2 col-form-label"><?php echo i18n('Export_phpbb_url');?></label>
      <div class="col-sm-10">
        <input type="text" name="-config-export.phpbb.url" class="form-control" id="export-phpbb-url" value="<?php echo config('export.phpbb.url');?>" placeholder="<?php echo i18n('Export_phpbb_url');?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="export-phpbb-forum-id" class="col-sm-2 col-form-label"><?php echo i18n('Export_phpbb_forum_id');?></label>
      <div class="col-sm-10">
        <input type="number" name="-config-export.phpbb.forumid" class="form-control" id="export-phpbb-forum-id" value="<?php echo valueMaker(config('export.phpbb.forumid'));?>" placeholder="<?php echo i18n('Export_phpbb_forum_id');?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="export-phpbb-user-id" class="col-sm-2 col-form-label"><?php echo i18n('Export_phpbb_user_id');?></label>
      <div class="col-sm-10">
        <input type="number" name="-config-export.phpbb.userid" class="form-control" id="export-phpbb-user-id" value="<?php echo valueMaker(config('export.phpbb.userid'));?>" placeholder="<?php echo i18n('Export_phpbb_user_id');?>">
      </div>
    </div>
  </div>

  <!-- Export news to Telegram -->
  <h4>Telegram</h4>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label"><?php echo i18n('Enable_export_telegram');?></label>
    <div class="col-sm-10">
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="-config-export.telegram.enable" id="export-telegram.enable1" value="true" <?php if (config('export.telegram.enable') === 'true'):?>checked<?php endif;?> onChange="javascript: document.getElementById('export-telegram-settings').setAttribute('class', '');">
          <label class="form-check-label" for="export-telegram.enable1">
            <?php echo i18n('Enable');?>
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="-config-export.telegram.enable" id="export-telegram.enable2" value="false" <?php if (config('export.telegram.enable') === 'false'):?>checked<?php endif;?> onChange="javascript: document.getElementById('export-telegram-settings').setAttribute('class', 'disabled');">
          <label class="form-check-label" for="export-telegram.enable2">
            <?php echo i18n('Disable');?>
          </label>
        </div>
      </div>
      <small><em><?php echo i18n('Explain_export_telegram');?></em></small>
    </div>
  </div>
  <div class="<?php if (config('export.telegram.enable') === 'false'):?>disabled<?php endif;?>" id="export-telegram-settings">
    <div class="form-group row">
      <label for="export-telegram-token" class="col-sm-2 col-form-label"><?php echo i18n('Export_telegram_token');?></label>
      <div class="col-sm-10">
        <input type="text" name="-config-export.telegram.token" class="form-control" id="export-telegram-token" value="<?php echo config('export.telegram.token');?>" placeholder="<?php echo i18n('Export_telegram_token');?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="export-telegram-channelid" class="col-sm-2 col-form-label"><?php echo i18n('Export_telegram_channelid');?></label>
      <div class="col-sm-10">
        <input type="text" name="-config-export.telegram.channelid" class="form-control" id="export-telegram-channelid" value="<?php echo valueMaker(config('export.telegram.channelid'));?>" placeholder="<?php echo i18n('Export_telegram_channelid');?>">
      </div>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary"><?php echo i18n('Save_Config');?></button>
    </div>
  </div>
</form>