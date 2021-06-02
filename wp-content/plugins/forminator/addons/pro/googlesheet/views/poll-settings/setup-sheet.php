<?php
// Defaults
$vars = array(
	'error_message'   => '',
	'folder_id'       => '',
	'folder_id_error' => '',
	'file_name'       => '',
	'file_name_error' => '',
	'file_id'         => '',
);

/** @var array $template_vars */
foreach ( $template_vars as $key => $val ) {
	$vars[ $key ] = $val;
} ?>

<div class="integration-header">

	<h3 class="sui-box-title" id="dialogTitle2"><?php echo esc_html( __( 'Create Spread Sheet', 'forminator' ) ); ?></h3>
	<p><?php esc_html_e( 'Create Spreadsheet that will be used to send submissions.', 'forminator' ); ?></p>
	<?php if ( ! empty( $vars['file_id'] ) ) : ?>
		<span class="sui-notice sui-notice-info"><p>
		<?php esc_html_e( 'You can open your current spread sheet', 'forminator' ); ?>
				<a target="_blank" href="https://docs.google.com/spreadsheets/d/<?php echo esc_attr( $vars['file_id'] ); ?>"><?php esc_html_e( 'here', 'forminator' ); ?></a>.</p></span>
	<?php endif; ?>
	<?php if ( ! empty( $vars['error_message'] ) ) : ?>
		<span class="sui-notice sui-notice-error"><p><?php echo esc_html( $vars['error_message'] ); ?></p></span>
	<?php endif; ?>
</div>
<form>
	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['folder_id_error'] ) ? 'sui-form-field-error' : '' ); ?>">
		<label class="sui-label"><?php esc_html_e( 'Drive Folder ID', 'forminator' ); ?></label>
		<input
				class="sui-form-control"
				name="folder_id" placeholder="<?php echo esc_attr( __( 'Folder ID', 'forminator' ) ); ?>"
				value="<?php echo esc_attr( $vars['folder_id'] ); ?>">
		<?php if ( ! empty( $vars['folder_id_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['folder_id_error'] ); ?></span>
		<?php endif; ?>
		<span class="sui-description">
			<ol class="instructions" id="directory-instructions" style="display: block;">
				<li>
					<?php esc_html_e( 'It is optional, if Drive Folder ID omitted / empty, new spreadsheet will be created in your Google Drive home / root folder.', 'forminator' ); ?>
				</li>
				<li>
					<?php
					echo sprintf(/* translators: ... */
						esc_html__( 'Go to your %1$s.', 'forminator' ),
						'<a href="https://drive.google.com/#my-drive" target="_blank">' . esc_html__( 'Drive account', 'forminator' ) . '</a>'
					); //phpcs:ignore Standard.Category.SniffName.ErrorCode
					?>
					<?php esc_html_e( 'Navigate to or create a new directory where you want to create a new spreadsheet. Make sure you are viewing the destination directory.', 'forminator' ); ?>
				</li>
				<li>
				<?php
				echo sprintf(/* translators: ... */
					esc_html__( 'The URL for the directory will be something similar to %1$s. The Directory ID would be the last part after %2$s, which is %3$s in this case.', 'forminator' ),
					'<em>https://drive.google.com/#folders/0B6GD66ctHXdCOWZKNDRIRGJJXS3</em>',
					'<em>/#folders/</em>',
					'<strong>0B6GD66ctHXdCOWZKNDRIRGJJXS3</strong>'
				); //phpcs:ignore Standard.Category.SniffName.ErrorCode
				?>
				</li>
			</ol>
		</span>
	</div>

	<div class="sui-form-field <?php echo esc_attr( ! empty( $vars['file_name_error'] ) ? 'sui-form-field-error' : '' ); ?>">
		<label class="sui-label"><?php esc_html_e( 'Spreadsheet File Name', 'forminator' ); ?></label>
		<input
				class="sui-form-control"
				name="file_name" placeholder="<?php echo esc_attr( __( 'File Name', 'forminator' ) ); ?>"
				value="<?php echo esc_attr( $vars['file_name'] ); ?>">
		<?php if ( ! empty( $vars['file_name_error'] ) ) : ?>
			<span class="sui-error-message"><?php echo esc_html( $vars['file_name_error'] ); ?></span>
		<?php endif; ?>
	</div>

	<input type="hidden" name="multi_id" value="<?php echo esc_attr( $vars['multi_id'] ); ?>">
</form>