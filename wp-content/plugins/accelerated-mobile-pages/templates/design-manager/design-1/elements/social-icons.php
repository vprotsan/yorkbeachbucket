<?php global $redux_builder_amp;  
	if ( is_single() ) { 
		$permalink = '';
		if(isset($redux_builder_amp['enable-single-twitter-share-link']) && $redux_builder_amp['enable-single-twitter-share-link']){
			$permalink = get_the_permalink();
		}
		else
			$permalink = wp_get_shortlink();
		?>
<?php do_action('ampforwp_before_social_icons_hook',$this); ?>
	<div class="ampforwp-social-icons">
		<?php if( true == $redux_builder_amp['ampforwp-facebook-like-button'] ) {
			$facebook_like_url = '';
			$facebook_like_url = get_the_permalink();
			if( $facebook_like_url ){ ?>
				<amp-facebook-like width=90 height=28
				 	layout="fixed"
				 	data-size="large"
				    data-layout="button_count"
				    data-href="<?php echo esc_url($facebook_like_url); ?>">
				</amp-facebook-like>
			<?php }
		} ?>	   
		<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
			<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  {
	    $data_param_data = $redux_builder_amp['enable-single-twitter-share-handle'];?>
			<amp-social-share type="twitter"
				width="50"
				height="28"
				data-param-url=""
				data-param-text="TITLE <?php echo $permalink.' '.ampforwp_translation( $redux_builder_amp['amp-translator-via-text'], 'via' ).' '.$data_param_data ?>"
			></amp-social-share>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
			<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
			<amp-social-share type="email"      width="50" height="28"></amp-social-share>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
			<amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
			<amp-social-share type="linkedin" width="50" height="28"></amp-social-share>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-whatsapp-share'] == true)  { ?>
			<a href="whatsapp://send?text=<?php echo get_the_permalink(); ?>">
				<div class="amp-social-icon">
				    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" />
			    </div>
			</a>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-line-share'] == true)  { ?>
			<a href="http://line.me/R/msg/text/?<?php echo get_the_permalink(); ?>">
				<div class="amp-social-icon custom-amp-socialsharing-line">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-vk-share'] == true)  { ?>
			<a href="http://vk.com/share.php?url=<?php echo get_the_permalink(); ?>">
				<div class="amp-social-icon custom-amp-socialsharing-vk"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDQuMzYgMzA0LjM2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMDQuMzYgMzA0LjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGcgaWQ9IlhNTElEXzFfIj4KCTxwYXRoIGlkPSJYTUxJRF84MDdfIiBzdHlsZT0iZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7IiBkPSJNMjYxLjk0NSwxNzUuNTc2YzEwLjA5Niw5Ljg1NywyMC43NTIsMTkuMTMxLDI5LjgwNywyOS45ODIgICBjNCw0LjgyMiw3Ljc4Nyw5Ljc5OCwxMC42ODQsMTUuMzk0YzQuMTA1LDcuOTU1LDAuMzg3LDE2LjcwOS02Ljc0NiwxNy4xODRsLTQ0LjM0LTAuMDJjLTExLjQzNiwwLjk0OS0yMC41NTktMy42NTUtMjguMjMtMTEuNDc0ICAgYy02LjEzOS02LjI1My0xMS44MjQtMTIuOTA4LTE3LjcyNy0xOS4zNzJjLTIuNDItMi42NDItNC45NTMtNS4xMjgtNy45NzktNy4wOTNjLTYuMDUzLTMuOTI5LTExLjMwNy0yLjcyNi0xNC43NjYsMy41ODcgICBjLTMuNTIzLDYuNDIxLTQuMzIyLDEzLjUzMS00LjY2OCwyMC42ODdjLTAuNDc1LDEwLjQ0MS0zLjYzMSwxMy4xODYtMTQuMTE5LDEzLjY2NGMtMjIuNDE0LDEuMDU3LTQzLjY4Ni0yLjMzNC02My40NDctMTMuNjQxICAgYy0xNy40MjItOS45NjgtMzAuOTMyLTI0LjA0LTQyLjY5MS0zOS45NzFDMzQuODI4LDE1My40ODIsMTcuMjk1LDExOS4zOTUsMS41MzcsODQuMzUzQy0yLjAxLDc2LjQ1OCwwLjU4NCw3Mi4yMiw5LjI5NSw3Mi4wNyAgIGMxNC40NjUtMC4yODEsMjguOTI4LTAuMjYxLDQzLjQxLTAuMDJjNS44NzksMC4wODYsOS43NzEsMy40NTgsMTIuMDQxLDkuMDEyYzcuODI2LDE5LjI0MywxNy40MDIsMzcuNTUxLDI5LjQyMiw1NC41MjEgICBjMy4yMDEsNC41MTgsNi40NjUsOS4wMzYsMTEuMTEzLDEyLjIxNmM1LjE0MiwzLjUyMSw5LjA1NywyLjM1NCwxMS40NzYtMy4zNzRjMS41MzUtMy42MzIsMi4yMDctNy41NDQsMi41NTMtMTEuNDM0ICAgYzEuMTQ2LTEzLjM4MywxLjI5Ny0yNi43NDMtMC43MTMtNDAuMDc5Yy0xLjIzNC04LjMyMy01LjkyMi0xMy43MTEtMTQuMjI3LTE1LjI4NmMtNC4yMzgtMC44MDMtMy42MDctMi4zOC0xLjU1NS00Ljc5OSAgIGMzLjU2NC00LjE3Miw2LjkxNi02Ljc2OSwxMy41OTgtNi43NjloNTAuMTExYzcuODg5LDEuNTU3LDkuNjQxLDUuMTAxLDEwLjcyMSwxMy4wMzlsMC4wNDMsNTUuNjYzICAgYy0wLjA4NiwzLjA3MywxLjUzNSwxMi4xOTIsNy4wNywxNC4yMjZjNC40MywxLjQ0OCw3LjM1LTIuMDk2LDEwLjAwOC00LjkwNWMxMS45OTgtMTIuNzM0LDIwLjU2MS0yNy43ODMsMjguMjExLTQzLjM2NiAgIGMzLjM5NS02Ljg1Miw2LjMxNC0xMy45NjgsOS4xNDMtMjEuMDc4YzIuMDk2LTUuMjc2LDUuMzg1LTcuODcyLDExLjMyOC03Ljc1N2w0OC4yMjksMC4wNDNjMS40MywwLDIuODc3LDAuMDIxLDQuMjYyLDAuMjU4ICAgYzguMTI3LDEuMzg1LDEwLjM1NCw0Ljg4MSw3Ljg0NCwxMi44MTdjLTMuOTU1LDEyLjQ1MS0xMS42NSwyMi44MjctMTkuMTc0LDMzLjI1MWMtOC4wNDMsMTEuMTI5LTE2LjY0NSwyMS44NzctMjQuNjIxLDMzLjA3MiAgIEMyNTIuMjYsMTYxLjU0NCwyNTIuODQyLDE2Ni42OTcsMjYxLjk0NSwxNzUuNTc2TDI2MS45NDUsMTc1LjU3NnogTTI2MS45NDUsMTc1LjU3NiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-odnoklassniki-share'] == true)  { ?>
			<a href="https://ok.ru/dk?st.cmd=addShare&st._surl=<?php echo get_the_permalink(); ?>" target="_blank">
				<div class="amp-social-icon amp-social-odnoklassniki"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDk1LjQ4MSA5NS40ODEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDk1LjQ4MSA5NS40ODE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDMuMDQxLDY3LjI1NGMtNy40MDItMC43NzItMTQuMDc2LTIuNTk1LTE5Ljc5LTcuMDY0Yy0wLjcwOS0wLjU1Ni0xLjQ0MS0xLjA5Mi0yLjA4OC0xLjcxMyAgICBjLTIuNTAxLTIuNDAyLTIuNzUzLTUuMTUzLTAuNzc0LTcuOTg4YzEuNjkzLTIuNDI2LDQuNTM1LTMuMDc1LDcuNDg5LTEuNjgyYzAuNTcyLDAuMjcsMS4xMTcsMC42MDcsMS42MzksMC45NjkgICAgYzEwLjY0OSw3LjMxNywyNS4yNzgsNy41MTksMzUuOTY3LDAuMzI5YzEuMDU5LTAuODEyLDIuMTkxLTEuNDc0LDMuNTAzLTEuODEyYzIuNTUxLTAuNjU1LDQuOTMsMC4yODIsNi4yOTksMi41MTQgICAgYzEuNTY0LDIuNTQ5LDEuNTQ0LDUuMDM3LTAuMzgzLDcuMDE2Yy0yLjk1NiwzLjAzNC02LjUxMSw1LjIyOS0xMC40NjEsNi43NjFjLTMuNzM1LDEuNDQ4LTcuODI2LDIuMTc3LTExLjg3NSwyLjY2MSAgICBjMC42MTEsMC42NjUsMC44OTksMC45OTIsMS4yODEsMS4zNzZjNS40OTgsNS41MjQsMTEuMDIsMTEuMDI1LDE2LjUsMTYuNTY2YzEuODY3LDEuODg4LDIuMjU3LDQuMjI5LDEuMjI5LDYuNDI1ICAgIGMtMS4xMjQsMi40LTMuNjQsMy45NzktNi4xMDcsMy44MWMtMS41NjMtMC4xMDgtMi43ODItMC44ODYtMy44NjUtMS45NzdjLTQuMTQ5LTQuMTc1LTguMzc2LTguMjczLTEyLjQ0MS0xMi41MjcgICAgYy0xLjE4My0xLjIzNy0xLjc1Mi0xLjAwMy0yLjc5NiwwLjA3MWMtNC4xNzQsNC4yOTctOC40MTYsOC41MjgtMTIuNjgzLDEyLjczNWMtMS45MTYsMS44ODktNC4xOTYsMi4yMjktNi40MTgsMS4xNSAgICBjLTIuMzYyLTEuMTQ1LTMuODY1LTMuNTU2LTMuNzQ5LTUuOTc5YzAuMDgtMS42MzksMC44ODYtMi44OTEsMi4wMTEtNC4wMTRjNS40NDEtNS40MzMsMTAuODY3LTEwLjg4LDE2LjI5NS0xNi4zMjIgICAgQzQyLjE4Myw2OC4xOTcsNDIuNTE4LDY3LjgxMyw0My4wNDEsNjcuMjU0eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik00Ny41NSw0OC4zMjljLTEzLjIwNS0wLjA0NS0yNC4wMzMtMTAuOTkyLTIzLjk1Ni0yNC4yMThDMjMuNjcsMTAuNzM5LDM0LjUwNS0wLjAzNyw0Ny44NCwwICAgIGMxMy4zNjIsMC4wMzYsMjQuMDg3LDEwLjk2NywyNC4wMiwyNC40NzhDNzEuNzkyLDM3LjY3Nyw2MC44ODksNDguMzc1LDQ3LjU1LDQ4LjMyOXogTTU5LjU1MSwyNC4xNDMgICAgYy0wLjAyMy02LjU2Ny01LjI1My0xMS43OTUtMTEuODA3LTExLjgwMWMtNi42MDktMC4wMDctMTEuODg2LDUuMzE2LTExLjgzNSwxMS45NDNjMC4wNDksNi41NDIsNS4zMjQsMTEuNzMzLDExLjg5NiwxMS43MDkgICAgQzU0LjM1NywzNS45NzEsNTkuNTczLDMwLjcwOSw1OS41NTEsMjQuMTQzeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-reddit-share'] ) { ?>
			<a href="https://reddit.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" target="_blank">
				<div class="amp-social-icon amp-social-reddit"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDQ5IDUxMiIgZmlsbD0iI2ZmZmZmZiIgPjxwYXRoIGQ9Ik00NDkgMjUxYzAgMjAtMTEgMzctMjcgNDUgMSA1IDEgOSAxIDE0IDAgNzYtODkgMTM4LTE5OSAxMzhTMjYgMzg3IDI2IDMxMWMwLTUgMC0xMCAxLTE1LTE2LTgtMjctMjUtMjctNDUgMC0yOCAyMy01MCA1MC01MCAxMyAwIDI0IDUgMzMgMTMgMzMtMjMgNzktMzkgMTI5LTQxaDJsMzEtMTAzIDkwIDE4YzgtMTQgMjItMjQgMzktMjRoMWMyNSAwIDQ0IDIwIDQ0IDQ1cy0xOSA0NS00NCA0NWgtMWMtMjMgMC00Mi0xNy00NC00MGwtNjctMTQtMjIgNzRjNDkgMyA5MyAxNyAxMjUgNDAgOS04IDIxLTEzIDM0LTEzIDI3IDAgNDkgMjIgNDkgNTB6TTM0IDI3MWM1LTE1IDE1LTI5IDI5LTQxLTQtMy05LTUtMTUtNS0xNCAwLTI1IDExLTI1IDI1IDAgOSA0IDE3IDExIDIxem0zMjQtMTYyYzAgOSA3IDE3IDE2IDE3czE3LTggMTctMTctOC0xNy0xNy0xNy0xNiA4LTE2IDE3ek0xMjcgMjg4YzAgMTggMTQgMzIgMzIgMzJzMzItMTQgMzItMzItMTQtMzEtMzItMzEtMzIgMTMtMzIgMzF6bTk3IDExMmM0OCAwIDc3LTI5IDc4LTMwbC0xMy0xMnMtMjUgMjQtNjUgMjRjLTQxIDAtNjQtMjQtNjQtMjRsLTEzIDEyYzEgMSAyOSAzMCA3NyAzMHptNjctODBjMTggMCAzMi0xNCAzMi0zMnMtMTQtMzEtMzItMzEtMzIgMTMtMzIgMzEgMTQgMzIgMzIgMzJ6bTEyNC00OGM3LTUgMTEtMTMgMTEtMjIgMC0xNC0xMS0yNS0yNS0yNS02IDAtMTEgMi0xNSA1IDE0IDEyIDI0IDI3IDI5IDQyeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-tumblr-share'] ) { ?>
			<a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url(get_the_permalink()); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&caption=<?php echo esc_attr(get_the_excerpt()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-tumblr"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMzYuMDAyIDI4djE0LjYzNmMwIDMuNzE0LS4wNDggNS44NTMuMzQ2IDYuOTA2LjM5IDEuMDQ3IDEuMzcgMi4xMzQgMi40MzcgMi43NjMgMS40MTguODUgMy4wMzQgMS4yNzMgNC44NTcgMS4yNzMgMy4yNCAwIDUuMTU1LS40MjggOC4zNi0yLjUzNHY5LjYyYy0yLjczMiAxLjI4Ni01LjExOCAyLjAzOC03LjMzNCAyLjU2LTIuMjIuNTE0LTQuNjE2Ljc3NC03LjE5Ljc3NC0yLjkyOCAwLTQuNjU1LS4zNjgtNi45MDItMS4xMDMtMi4yNDctLjc0Mi00LjE2Ni0xLjgtNS43NS0zLjE2LTEuNTkyLTEuMzctMi42OS0yLjgyNC0zLjMwNC00LjM2M3MtLjkyLTMuNzc2LS45Mi02LjcwM1YyNi4yMjRoLTguNTl2LTkuMDYzYzIuNTE0LS44MTUgNS4zMjQtMS45ODcgNy4xMTItMy41MSAxLjc5Ny0xLjUyNyAzLjIzNS0zLjM1NiA0LjMyLTUuNDk2QzI0LjUzIDYuMDIyIDI1LjI3NiAzLjMgMjUuNjgzIDBoMTAuMzJ2MTZINTJ2MTJIMzYuMDA0eiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-telegram-share'] ) { ?>
			<a href="https://telegram.me/share/url?url=<?php echo esc_url(get_the_permalink()); ?>&text=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" target="_blank">
				<div class="amp-social-icon amp-social-telegram"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjYgMjYiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCAydjguNUwxNSAxMyAwIDE1LjVWMjRsMjYtMTFMMCAyeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-digg-share'] ) { ?>
			<a href="http://digg.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" target="_blank">
				<div class="amp-social-icon amp-social-digg"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjA0OCAxODk2LjA4MzMiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMzI4IDI4MmgyMDR2OTgzSDBWNTY4aDMyOFYyODJ6bTAgODE5VjczMkgyMDV2MzY5aDEyM3ptMjg2LTUzM3Y2OTdoMjA1VjU2OEg2MTR6bTAtMjg2djIwNGgyMDVWMjgySDYxNHptMjg3IDI4Nmg1MzN2OTQySDkwMXYtMTYzaDMyOHYtODJIOTAxVjU2OHptMzI4IDUzM1Y3MzJoLTEyM3YzNjloMTIzem0yODctNTMzaDUzMnY5NDJoLTUzMnYtMTYzaDMyN3YtODJoLTMyN1Y1Njh6bTMyNyA1MzNWNzMyaC0xMjN2MzY5aDEyM3oiPjwvcGF0aD48L3N2Zz4=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-stumbleupon-share'] ) { ?>
			<a href="http://www.stumbleupon.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" target="_blank">
				<div class="amp-social-icon amp-social-stumbleupon"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjcwLjIyMzMgNjAxLjA4NjkiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCA0MzcuMjQ3di05Mi42NzJoMTE0LjY4OHY5MS42NjRjMCA5LjU2NyAzLjQwOCAxNy44MjMgMTAuMjQgMjQuODNzMTUuMTg0IDEwLjQ5NyAyNS4wODggMTAuNDk3IDE4LjMzNi0zLjQyNCAyNS4zNDQtMTAuMjRjNy4wMDgtNi44NDggMTAuNDk2LTE1LjIgMTAuNDk2LTI1LjA4OFYyMTkuNjQ2YzAtMzkuOTM1IDE0Ljc1Mi03My45ODQgNDQuMjg4LTEwMi4xNDQgMjkuNTM2LTI4LjE2IDY0LjYwOC00Mi4yNCAxMDUuMjE2LTQyLjI0IDQwLjYwOCAwIDc1LjY4IDE0LjE2IDEwNS4yMTYgNDIuNDk2IDI5LjUyIDI4LjMzNSA0NC4zMDUgNjIuNjQgNDQuMzA1IDEwMi45MXY0Ny4xMDRsLTY4LjYyMyAyMC40OC00NS41Ny0yMS41MDN2LTQwLjk2YzAtOS45MDMtMy40MDctMTguMjU2LTEwLjI1NS0yNS4wODgtNi44MTYtNi44MzItMTUuMTgzLTEwLjI0LTI1LjA3Mi0xMC4yNC05LjkwMyAwLTE4LjMzNiAzLjQwOC0yNS4zNDQgMTAuMjRzLTEwLjQ5NiAxNS4xODUtMTAuNDk2IDI1LjA5djIxMy41MDNjMCA0MC45NzYtMTQuNjcyIDc1Ljg3Mi00NC4wMzIgMTA0LjcyLTI5LjM0NCAyOC44NDgtNjQuNTEyIDQzLjI0OC0xMDUuNDcyIDQzLjI0OC00MS4zMSAwLTc2LjY0LTE0LjU5Mi0xMDUuOTg0LTQzLjc3NkMxNC42ODggNTE0LjMwMy4wMDIgNDc4Ljg4LjAwMiA0MzcuMjQ3em0zNzAuNjg4IDEuNTM2di05My42OTVsNDUuNTY4IDIxLjUyIDY4LjYyNC0yMC40OTd2OTQuMjI2YzAgOS45MDMgMy40MDggMTguMzM2IDEwLjIyNCAyNS4zNDQgNi44NDcgNy4wMDcgMTUuMiAxMC40OTYgMjUuMDg3IDEwLjQ5NiA5LjkwNiAwIDE4LjI3NC0zLjUwNCAyNS4wOS0xMC40OTYgNi44MTYtNi45OTMgMTAuMjU1LTE1LjQ0IDEwLjI1NS0yNS4zNDR2LTk1Ljc0NGgxMTQuNjg4djkyLjY3MmMwIDQxLjI5NS0xNC41OSA3Ni42NC00My43NzYgMTA1Ljk4My0yOS4xODQgMjkuMzYtNjQuNDMyIDQ0LjAzMi0xMDUuNzI4IDQ0LjAzMnMtNzYuNjI1LTE0LjQ5Ny0xMDUuOTg1LTQzLjUyYy0yOS4zNi0yOS4wNC00NC4wNDgtNjQuMDE3LTQ0LjA0OC0xMDQuOTc4eiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-wechat-share'] ) { ?>
			<a href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php echo esc_url(get_the_permalink()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-wechat"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjA0OCAxODk2LjA4MzMiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNNTgwIDQ2MXEwLTQxLTI1LTY2dC02Ni0yNXEtNDMgMC03NiAyNS41VDM4MCA0NjFxMCAzOSAzMyA2NC41dDc2IDI1LjVxNDEgMCA2Ni0yNC41dDI1LTY1LjV6bTc0MyA1MDdxMC0yOC0yNS41LTUwdC02NS41LTIycS0yNyAwLTQ5LjUgMjIuNVQxMTYwIDk2OHEwIDI4IDIyLjUgNTAuNXQ0OS41IDIyLjVxNDAgMCA2NS41LTIydDI1LjUtNTF6bS0yMzYtNTA3cTAtNDEtMjQuNS02NlQ5OTcgMzcwcS00MyAwLTc2IDI1LjVUODg4IDQ2MXEwIDM5IDMzIDY0LjV0NzYgMjUuNXE0MSAwIDY1LjUtMjQuNVQxMDg3IDQ2MXptNjM1IDUwN3EwLTI4LTI2LTUwdC02NS0yMnEtMjcgMC00OS41IDIyLjVUMTU1OSA5NjhxMCAyOCAyMi41IDUwLjV0NDkuNSAyMi41cTM5IDAgNjUtMjJ0MjYtNTF6bS0yNjYtMzk3cS0zMS00LTcwLTQtMTY5IDAtMzExIDc3VDg1MS41IDg1Mi41IDc3MCAxMTQwcTAgNzggMjMgMTUyLTM1IDMtNjggMy0yNiAwLTUwLTEuNXQtNTUtNi41LTQ0LjUtNy01NC41LTEwLjUtNTAtMTAuNWwtMjUzIDEyNyA3Mi0yMThRMCA5NjUgMCA2NzhxMC0xNjkgOTcuNS0zMTF0MjY0LTIyMy41VDcyNSA2MnExNzYgMCAzMzIuNSA2NnQyNjIgMTgyLjVUMTQ1NiA1NzF6bTU5MiA1NjFxMCAxMTctNjguNSAyMjMuNVQxNzk0IDE1NDlsNTUgMTgxLTE5OS0xMDlxLTE1MCAzNy0yMTggMzctMTY5IDAtMzExLTcwLjVUODk3LjUgMTM5NiA4MTYgMTEzMnQ4MS41LTI2NFQxMTIxIDY3Ni41dDMxMS03MC41cTE2MSAwIDMwMyA3MC41dDIyNy41IDE5MlQyMDQ4IDExMzJ6Ij48L3BhdGg+PC9zdmc+" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-viber-share'] ) { ?>
			<a href="viber://forward?text=<?php echo esc_url(get_the_permalink()); ?>" target="_blank">
				<div class="amp-social-icon amp-social-viber"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAyNiAxMjM0IiBmaWxsPSIjZmZmZmZmIiA+PHBhdGggZD0iTTkwNCA3OTRxLTY5IDYxLTIwMCA4Ny41VDQzNCA4OTdsLTE3NiAxMzJWODY0cS04Ny0yNy0xMzYtNzAtNTgtNTEtOTAtMTQ2LjV0LTMyLTE5NSAzMi0xOTUgOTAuNS0xNDcgMTY3LjUtNzlUNTEzIDR0MjIzIDI3LjUgMTY3LjUgNzkgOTAuNSAxNDcgMzIgMTk1LTMyIDE5NVQ5MDQgNzk0ek02MzkgNTQ5bDY1IDExcS04LTEyMC05Mi41LTIwNVQ0MDcgMjYybDExIDY1cTg2IDExIDE0OCA3M3Q3MyAxNDl6TTQyOSAzOTRsMTIgNzJxNDAgMjAgNTkgNTlsNzIgMTJxLTEyLTUzLTUxLTkxLjVUNDI5IDM5NHptLTEwNyA1OXYtNjRxMC0xNy0xMi41LTM0VDI4MyAzMzAuNXQtMjEtMS41bC00NiA0N3EtMzkgMzktMTEuNSAxMjEuNXQxMDUgMTYwIDE2MCAxMDVUNTkwIDc1MWw0Ny00N3E3LTYtLjUtMjAuNVQ2MTIgNjU3dC0zNC0xMmgtNjRsLTM3IDMycS00NC0xMi0xMDkuNS03Ny41VDI5MCA0ODl6bTY0LTMyMGwxMCA2NXExMDAgMiAxODUgNTIuNXQxMzUgMTM1VDc2OSA1NzBsNjUgMTFxMC05MS0zNS41LTE3NFQ3MDMgMjY0dC0xNDMtOTUuNVQzODYgMTMzeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
	</div>
<?php } ?>

<?php do_action('ampforwp_after_social_icons_hook',$this);