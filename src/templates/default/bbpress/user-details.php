<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

do_action( 'bbp_template_before_user_details' ); ?>

<div id="bbp-single-user-details">
	<div id="bbp-user-avatar">
		<span class='vcard'>
			<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
				<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
			</a>
		</span>
	</div>

	<?php do_action( 'bbp_template_before_user_details_menu_items' ); ?>

	<?php
		$ID = bbp_get_user_id();
		
		//Get the URL and append ID
		$maybe_url = 'https://progettogamp.altervista.org/wp-admin/users.php?action=delete&user='.$ID;
		
		//Now get the previous URL, with the correct nonce
		$complete_url = wp_nonce_url( $maybe_url, 'bulk-users' );
		
		// Get ID of the profile we are viewing
		$profile_ID = bbp_get_user_id( $user->ID );
		
		// Get current user ID
		$current_user_id = bbp_get_current_user_id();
	?>

	<div id="bbp-user-navigation">
		<ul>
			<li class="<?php if ( bbp_is_single_user_profile() ) : ?>current<?php endif; ?>">
				<span class="vcard bbp-user-profile-link">
					<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( esc_attr__( "%s's Profile", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>" rel="me"><?php esc_html_e( 'Profile', 'bbpress' ); ?></a>
				</span>
			</li>

			<li class="<?php if ( bbp_is_single_user_topics() ) : ?>current<?php endif; ?>">
				<span class='bbp-user-topics-created-link'>
					<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Progetti creati", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Progetti creati', 'bbpress' ); ?></a>
				</span>
			</li>

			<li class="<?php if ( bbp_is_single_user_replies() ) : ?>current<?php endif; ?>">
			
				<?php if ( $profile_ID == $current_user_id ) : ?>	
					<span class='bbp-user-replies-created-link'>
						<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Progetti di cui fai parte", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Progetti di cui fai parte', 'bbpress' ); ?></a>
					</span>
				<?php endif; ?>

				<?php if ( $profile_ID != $current_user_id ) : ?>	
					<span class='bbp-user-replies-created-link'>
						<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Partecipazioni", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Partecipazioni', 'bbpress' ); ?></a>
					</span>
				<?php endif; ?>	
				
			</li>

			<!-- <?php if ( bbp_is_engagements_active() ) : ?>
				<li class="<?php if ( bbp_is_single_user_engagements() ) : ?>current<?php endif; ?>">
					<span class='bbp-user-engagements-created-link'>
						<a href="<?php bbp_user_engagements_url(); ?>" title="<?php printf( esc_attr__( "%s's Engagements", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Engagements', 'bbpress' ); ?></a>
					</span>
				</li>
			<?php endif; ?>

			<?php if ( bbp_is_favorites_active() ) : ?>
				<li class="<?php if ( bbp_is_favorites() ) : ?>current<?php endif; ?>">
					<span class="bbp-user-favorites-link">
						<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Favorites", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Favorites', 'bbpress' ); ?></a>
					</span>
				</li>
			<?php endif; ?> -->

			<?php if ( bbp_is_user_home() || current_user_can( 'edit_user', bbp_get_displayed_user_id() ) ) : ?>

				 <!-- <?php if ( bbp_is_subscriptions_active() ) : ?>
					<li class="<?php if ( bbp_is_subscriptions() ) : ?>current<?php endif; ?>">
						<span class="bbp-user-subscriptions-link">
							<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Subscriptions", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Subscriptions', 'bbpress' ); ?></a>
						</span>
					</li>
				<?php endif; ?> -->

				<?php if ( ! bbp_is_user_keymaster() ) : ?>
				<li class="<?php if ( bbp_is_single_user_edit() ) : ?>current<?php endif; ?>">
					<span class="bbp-user-edit-link">
						<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( esc_attr__( "Edit %s's Profile", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Edit', 'bbpress' ); ?></a>
					</span>
				</li>
				<?php endif; ?>
				
				<?php if ( bbp_is_user_keymaster() ) : ?>
					<li class="<?php if ( bbp_is_single_user_edit() ) :?>current<?php endif; ?>">
						<span class="bbp-user-edit-link">
							<a href="<?php echo $complete_url; ?>" title="<?php printf( esc_attr__( "Elimina profilo", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Elimina profilo', 'bbpress' ); ?></a>
						</span>
					</li>
				<?php endif; ?>

				<?php if ( ! bbp_is_user_keymaster() ) : ?>				
					<li class="<?php if ( bbp_is_single_user_edit() ) :?>current<?php endif; ?>">
						<span class="bbp-user-edit-link">
							<a href="https://progettogamp.altervista.org/wp-admin/options.php?page=plugin_delete_me_confirmation" title="<?php printf( esc_attr__( "Elimina profilo", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php esc_html_e( 'Elimina profilo', 'bbpress' ); ?></a>
						</span>
					</li>
				<?php endif; ?>

			<?php endif; ?>

		</ul>

		<?php do_action( 'bbp_template_after_user_details_menu_items' ); ?>

	</div>
</div>

<?php do_action( 'bbp_template_after_user_details' );
