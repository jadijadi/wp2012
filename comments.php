<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'یک نظر مربوط به &ldquo;%2$s&rdquo;', '%1$s نظر مربوط به &ldquo;%2$s&rdquo;', get_comments_number(), 'twentytwelve' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'twentytwelve_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; نظرات قدیمی', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'نظرات جدید &rarr;', 'twentytwelve' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'متاسفانه امکان اظهار نظر وجود ندارد.' , 'twentytwelve' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

<?php

// Translate to Farsi

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit',
	'title_reply' => __( 'اظهار نظر کنید' ),
	'title_reply_to' => __( 'برای %s اظهار نظر کنید' ),
	'cancel_reply_link' => __( 'انصراف' ),
	'label_submit' => __( 'بفرست' ),
	'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( '', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'شما باید <a href="%s">وارد شوید</a> تا بتوانید نظر بدهید.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'شما بعنوان <a href="%1$s">%2$s</a> وارد شده‌اید. <a href="%3$s" title="از این حساب کاربری خارج شوید">خارج شوید?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'comment_notes_before' => '<p style="opacity:0.5" class="req-note">آدرس ایمیل شما فاش نخواهد شد. بخش‌های ستاره‌دار <i style="font-style:normal;color:red;">*</i> الزاما باید پر شوند.</p>',
	'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( __( 'شما میتوانید از تگ‌های<abbr title="HyperText Markup Language">HTML</abbr> استفاده کنید: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'اسم', 'domainreference' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.( $req ? '<span class="required"> * </span>' : '' ).'</p>',
		'email' => '<p class="comment-form-email"><label for="email">' . __( 'ایمیل', 'domainreference' ) . '</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '<span class="required"> * </span>' : '' ) . '</p>',
		'url' => '<p class="comment-form-url"><label for="url">' . __( 'وب‌سایت', 'domainreference' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' ) ) );


 comment_form($args); ?>

</div><!-- #comments .comments-area -->
