<?php

// Make sure the person is logged in and can manage options
if ( ! current_user_can( 'manage_options' ) ) {
	exit;
}

// Make sure that there is a backup provided
if ( empty( $_REQUEST['download'] ) ) {
	print 'No backup id provided';
	exit;
}

$backupID    = intval( $_REQUEST['download'] );
$backup_file = get_post_meta( $backupID, 'backup_location', true );

$backup_check = WPBU_BACKUP_DIR . '/' . basename( $backup_file );
if ( empty( $backup_file ) ) {
	print 'No backup found';
	exit;
}

$backup_check = WPBU_BACKUP_DIR . '/' . basename( $backup_file );
if ( ! is_readable( $backup_check ) ) {
	print 'No read rights to backup. Check your server permissions.';
	exit;
}

$file_name = basename( $backup_file );
header( "Content-Type: application/zip" );
header( "Content-Disposition: attachment; filename=$file_name" );
header( "Content-Length: " . filesize( $backup_file ) );
readfile( $backup_file );

exit;