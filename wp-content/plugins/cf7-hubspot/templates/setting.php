<?php
  if ( ! defined( 'ABSPATH' ) ) {
     exit;
 } ?><div class="crm_fields_table">
    <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_name"><?php esc_html_e("Account Name",'contact-form-hubspot-crm'); ?></label>
  </div>
  <div class="crm_field_cell2">
  <input type="text" name="crm[name]" value="<?php echo !empty($name) ? esc_html($name) : 'Account #'.esc_html($id); ?>" id="vx_name" class="crm_text">

  </div>
  <div class="clear"></div>
  </div>

  <div class="vx_tabs" id="tab_vx_web" style="<?php if($this->post('api',$info) != "web"){echo 'display:none';} ?>">
  <div class="crm_field">
  <div class="crm_field_cell1"><label for="org_id"><?php esc_html_e('HubSpot API Key','contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">
  <div class="vx_tr" >
  <div class="vx_td">
  <input type="password" id="org_id" name="crm[api_key]" class="crm_text" placeholder="<?php esc_html_e('HubSpot API Key','contact-form-hubspot-crm'); ?>" value="<?php echo $this->post('api_key',$info); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php esc_html_e('Toggle Key','contact-form-hubspot-crm'); ?>"><?php esc_html_e('Show Key','contact-form-hubspot-crm') ?></a>
  </div></div>
  </div>
  <div class="clear"></div>
  </div>  
  
  </div>
  <div class="vx_tabs" id="tab_vx_api" style="<?php if($this->post('api',$info) == "web"){echo 'display:none';} ?>">
  
  <div class="crm_field">
  <div class="crm_field_cell1"><label><?php esc_html_e('HubSpot Access','contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">
  <?php if(isset($info['access_token'])  && $info['access_token']!="") {
      $code='HubSpot'; if(!empty($info['portal_id'])){ $code.=' portal #'.$info['portal_id']; }
  ?>
  <div style="padding-bottom: 8px;" class="vx_green"><i class="fa fa-check"></i> <?php
  echo sprintf(esc_html__("Authorized Connection to %s on %s",'contact-form-hubspot-crm'),'<code>'.esc_html($code).'</code>',date('F d, Y h:i:s A',$info['_time']));
        ?></div>
  <?php
  }else{ //"automation" permission is not available in free version , throws error for free accounts , "content" permission
  ?>
  <a class="button button-default button-hero sf_login" data-id="<?php echo esc_html($client['client_id']) ?>" href="https://app.hubspot.com/oauth/authorize?scope=<?php echo urlencode('crm.objects.owners.read crm.objects.contacts.write crm.objects.companies.write crm.objects.companies.read crm.lists.read crm.schemas.contacts.read crm.objects.contacts.read crm.schemas.companies.read').'&optional_scope='.urlencode('forms tickets automation crm.schemas.deals.read crm.objects.deals.read crm.objects.deals.write crm.lists.read crm.lists.write content') ?>&state=<?php echo urlencode($link."&".$this->id."_tab_action=get_token&id=".$id."&vx_nonce=".$nonce);?>&client_id=<?php echo esc_html($client['client_id']) ?>&redirect_uri=<?php echo urlencode(esc_url($client['call_back'])) ?>" title="<?php esc_html_e("Login with HubSpot",'contact-form-hubspot-crm'); ?>" > <i class="fa fa-lock"></i> <?php esc_html_e("Login with HubSpot",'contact-form-hubspot-crm'); ?></a>
  <?php
  }
  ?></div>
  <div class="clear"></div>
  </div>                  
    <?php if(isset($info['access_token'])  && $info['access_token']!="") {
  ?>
    <div class="crm_field">
  <div class="crm_field_cell1"><label><?php esc_html_e("Revoke Access",'contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">  <a class="button button-secondary" id="vx_revoke" href="<?php echo esc_url($link."&".$this->id."_tab_action=get_token&vx_nonce=".$nonce.'&id='.$id); ?>"><i class="fa fa-unlock"></i> <?php esc_html_e("Revoke Access",'contact-form-hubspot-crm'); ?></a>
  </div>
  <div class="clear"></div>
  </div> 

  <?php
    }
  ?>
 
   <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_custom_app_check"><?php esc_html_e("HubSpot App",'contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2"><div><input type="checkbox" name="crm[custom_app]" id="vx_custom_app_check" value="yes" <?php if($this->post('custom_app',$info) == "yes"){echo 'checked="checked"';} ?> style="margin-right: 5px;"><?php echo esc_html__('Use Own Private HubSpot Keys ','contact-form-hubspot-crm'); $this->tooltip('vx_custom_app'); ?></div>
  </div>
  <div class="clear"></div>
  </div>
  <div id="vx_custom_app_div" style="<?php if($this->post('custom_app',$info) != "yes"){echo 'display:none';} ?>">
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_id"><?php esc_html_e('Client ID','contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">
     <div class="vx_tr">
  <div class="vx_td">
  <input type="password" id="app_id" name="crm[app_id]" class="crm_text" placeholder="<?php esc_html_e('Client ID','contact-form-hubspot-crm'); ?>" value="<?php echo $this->post('app_id',$info); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php esc_html_e('Toggle Consumer Key','contact-form-hubspot-crm'); ?>"><?php esc_html_e('Show Key','contact-form-hubspot-crm') ?></a>
  
  </div></div>
</div>
  <div class="clear"></div>
  </div>
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_secret"><?php esc_html_e('Client Secret','contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">
       <div class="vx_tr" >
  <div class="vx_td">
 <input type="password" id="app_secret" name="crm[app_secret]" class="crm_text"  placeholder="<?php esc_html_e('Client Secret','contact-form-hubspot-crm'); ?>" value="<?php echo $this->post('app_secret',$info); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php esc_html_e('Toggle Consumer Secret','contact-form-hubspot-crm'); ?>"><?php esc_html_e('Show Key','contact-form-hubspot-crm') ?></a>
  
  </div></div>
  </div>
  <div class="clear"></div>
  </div>
       <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_url"><?php esc_html_e("Redirect URL",'contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2"><input type="text" id="app_url" name="crm[app_url]" class="crm_text" placeholder="<?php esc_html_e("Redirect URL",'contact-form-hubspot-crm'); ?>" value="<?php echo $this->post('app_url',$info); ?>"> 
    <div class="howto">
   <div>1: <?php echo esc_url($link."&".$this->id."_tab_action=get_code");?></div>
   <div>2: https://www.crmperks.com/sf_auth/</div>
  </div>
  </div>
  <div class="clear"></div>
  </div>
  </div>
  </div> 
        <div class="crm_field">
  <div class="crm_field_cell1"><label><?php esc_html_e("Test Connection",'contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">      <button type="submit" class="button button-secondary" name="vx_test_connection"><i class="fa fa-refresh"></i> <?php esc_html_e("Test Connection",'contact-form-hubspot-crm'); ?></button>
  </div>
  <div class="clear"></div>
  </div> 
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_error_email"><?php esc_html_e("Notify by Email on Errors",'contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2"><textarea name="crm[error_email]" id="vx_error_email" placeholder="<?php esc_html_e("Enter comma separated email addresses",'contact-form-hubspot-crm'); ?>" class="crm_text" style="height: 70px"><?php echo isset($info['error_email']) ? esc_html($info['error_email']) : ""; ?></textarea>
  <span class="howto"><?php esc_html_e("Enter comma separated email addresses. An email will be sent to these email addresses if an order is not properly added to HubSpot. Leave blank to disable.",'contact-form-hubspot-crm'); ?></span>
  </div>
  <div class="clear"></div>
  </div> 
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_hub_analytics"><?php esc_html_e('HubSpot Analytics','contact-form-hubspot-crm'); ?></label></div>
  <div class="crm_field_cell2">
  <span class="howto"><?php echo sprintf(esc_html__('Add Hubspot Tracking Code in wordpress footer or install the %s HubSpot All-In-One Marketing %s','contact-form-hubspot-crm'),'<a href="https://wordpress.org/plugins/leadin/">','</a>'); ?></span>
  </div>
  <div class="clear"></div>
  </div> 
 
  <button type="submit" value="save" class="button-primary" title="<?php esc_html_e('Save Changes','contact-form-hubspot-crm'); ?>" name="save"><?php esc_html_e('Save Changes','contact-form-hubspot-crm'); ?></button>  
  </div>  