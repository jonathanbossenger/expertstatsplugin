<div class="wrap wpcable_wrap tasks">
	<h1
		class="list-title"
		data-none="<?php echo esc_attr( __( 'No tasks', 'wpcable' ) ); ?>"
		data-one="<?php echo esc_attr( __( 'One task', 'wpcable' ) ); ?>"
		data-many="<?php echo esc_attr( __( '[NUM] tasks', 'wpcable' ) ); ?>"
	>
		<?php esc_html_e( 'Your tasks', 'wpcable' ); ?>
	</h1>
	<ul class="subsubsub">
		<li class="all">
			<a href="#state=all">
				<?php esc_html_e( 'All', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="published">
			| <a href="#state=published">
				<?php esc_html_e( 'Published', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="estimated">
			| <a href="#state=estimated">
				<?php esc_html_e( 'Estimated', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="hired">
			| <a href="#state=hired">
				<?php esc_html_e( 'Hired', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="paid">
			| <a href="#state=paid">
				<?php esc_html_e( 'Paid', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="completed">
			| <a href="#state=completed">
				<?php esc_html_e( 'Completed', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="refunded">
			| <a href="#state=refunded">
				<?php esc_html_e( 'Refunded', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="canceled">
			| <a href="#state=canceled">
				<?php esc_html_e( 'Canceled', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
		<li class="lost">
			| <a href="#state=lost">
				<?php esc_html_e( 'Lost', 'wpcable' ); ?>
				<span class="count"></span>
			</a>
		</li>
	</ul>
	<p class="search-box">
		<input type="search" id="post-search-input" name="s" />
	</p>
	<div class="tablenav top">
		<div class="group">
			<label class="filter">
				<input type="checkbox" data-filter="no_hidden" />
				<?php esc_html_e( 'No hidden tasks', 'wpcable' ); ?>
			</label>
			<label class="filter">
				<input type="checkbox" data-filter="preferred" />
				⭐️ <?php esc_html_e( 'Preferred', 'wpcable' ); ?>
			</label>
			<label class="filter">
				<input type="checkbox" data-filter="promoted" />
				📣 <?php esc_html_e( 'Promoted', 'wpcable' ); ?>
			</label>
			<label class="filter">
				<input type="checkbox" data-filter="favored" />
				❤️ <?php esc_html_e( 'Favored', 'wpcable' ); ?>
			</label>
			<label class="filter">
				<input type="checkbox" data-filter="subscribed" />
				👁 <?php esc_html_e( 'Subscribed', 'wpcable' ); ?>
			</label>
		</div>
		<div class="group-right">
			<span class="group-label">Hide</span>
			<?php
			foreach ( $color_flags as $flag => $info ) {
				printf(
					'<label class="filter flag-%1$s"><span class="tooltip autosize small" tabindex="0"><span class="tooltip-text">%2$s</span><input type="checkbox" data-flag="%1$s" /><div class="color"></div></span></label>',
					esc_attr( $flag ),
					esc_html( $info['label'] )
				);
			}
			?>
		</div>
	</div>
	<table class="widefat striped">
		<thead>
			<tr>
				<th class="col-client"><?php esc_html_e( 'Client', 'wpcable' ); ?></th>
				<th class="col-activity sorted desc">
					<a href="#sort=activity">
						<span><?php esc_html_e( 'Activity', 'wpcable' ); ?></span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th class="col-workroom"><?php esc_html_e( 'Workroom', 'wpcable' ); ?></th>
				<th class="col-value"><?php esc_html_e( 'Value', 'wpcable' ); ?></th>
				<th class="col-title"><?php esc_html_e( 'Title', 'wpcable' ); ?></th>
				<th class="col-notes"><?php esc_html_e( 'Notes', 'wpcable' ); ?></th>
			</tr>
		</thead>
		<tbody class="task-list"></tbody>
	</table>
	<div class="notes-editor-layer" style="display:none">
		<div class="notes-editor">
			<h2 class="task-title"></h2>
			<textarea></textarea>
			<div class="buttons">
				<button class="button btn-cancel">Cancel</button>
				<button class="button button-primary btn-save">Save</button>
			</div>
		</div>
	</div>
	<?php codeable_last_fetch_info(); ?>
</div>
<script type="text/html" id="tmpl-list-item">
<# var staleHours = parseInt(((new Date() / 1000) - data.last_activity) / 3600); #>
<tr
	class="list-item state-{{{ data.state }}}<# if (data.preferred ) { #> task-preferred<# } #><# if ( data.hidden ) { #> task-hidden<# } #><# if (data.subscribed ) { #> task-subscribed<# } #><# if (data.favored ) { #> task-favored<# } #><# if (data.promoted ) { #> task-promoted<# } #><# if ( data.flag ) { #> flag-{{{ data.flag }}}<# } #><# if ( data.last_activity > 0 ) { #> age-<# if ( staleHours < 4 ) { #>current<# } else if ( staleHours < 24 ) { #>today<# } else if ( staleHours < 48 ) { #>yesterday<# } else if ( staleHours < 168 ) { #>week<# } else if ( staleHours < 336 ) { #>2weeks<# } else { #>older<# } } #>"
	id="task-{{{ data.task_id }}}"
	data-age="{{{ staleHours }}}"
>
	<td class="col-client">
		<div><img src="{{{ data.avatar }}}" /></div><div>{{{ data.client_name }}}</div>
	</td>
	<td class="col-activity">
		<# if ( data.last_activity > 0 ) { #>
			<span class="tooltip autosize right">
				<span class="tooltip-text">
					Last comment by <strong>{{{ data.last_activity_by }}}</strong>
				</span>
				<# if ( staleHours < 48 ) { #>
					<span class="activity-time">
						{{{ data.last_activity_time }}}
					</span><br />
				<# } #>
				<# if ( staleHours > 4 ) { #>
					<span class="activity-date">
						{{{ data.last_activity_date }}}
					</span>
				<# } #>
			</span>
		<# } else { #>
			-
		<# } #>
	</td>
	<td class="col-workroom">
		<a href="https://app.codeable.io/tasks/{{{ data.task_id }}}" target="_blank">
			<strong>#{{{ data.task_id }}}</strong>
		</a>
	</td>
	<td class="col-value">
		<# if ( data.value > 0 ) { #>
			<span class="your-value tooltip autosize">
				<span class="tooltip-text"><?php esc_html_e( 'Your earnings:', 'wpcable' ); ?> $<strong>{{{ parseInt( data.value ) }}}</strong></span>
				<span class="value"><small>$</small>{{{ parseInt( data.value ) }}}</span>
			</span><br />
			<small class="client-value tooltip bottom autosize">
				<span class="tooltip-text">{{{ "<?php esc_html_e( 'CLIENT pays:', 'wpcable' ); ?>".replace( 'CLIENT', data.client_name) }}} $<strong>{{{ parseInt( data.value_client ) }}}</strong></span>
				<span class="value"><small>$</small>{{{ parseInt( data.value_client ) }}}</span>
			</small>
		<# } #>
	</td>
	<td class="col-title">
		<div>
			<span class="task-title"><a href="https://app.codeable.io/tasks/{{{ data.task_id }}}" target="_blank">{{{ data.title }}}</a></span>
			<span class="task-flags">
			<# if ( data.preferred ) { #>
				<span class="tooltip bottom small autosize" tabindex="0">
					<span class="tooltip-text"><?php esc_html_e( 'Preferred', 'wpcable' ); ?></span>
					⭐️
				</span>
			<# } #>
			<# if ( data.promoted ) { #>
				<span class="tooltip bottom small autosize" tabindex="0">
					<span class="tooltip-text"><?php esc_html_e( 'Promoted', 'wpcable' ); ?></span>
					📣
				</span>
			<# } #>
			<# if ( data.favored ) { #>
				<span class="tooltip bottom small autosize" tabindex="0">
					<span class="tooltip-text"><?php esc_html_e( 'Favorited', 'wpcable' ); ?></span>
					️❤️
				</span>
			<# } #>
			<# if ( data.subscribed ) { #>
				<span class="tooltip bottom small autosize" tabindex="0">
					<span class="tooltip-text"><?php esc_html_e( 'Subscribed', 'wpcable' ); ?></span>
					👁
				</span>
			<# } #>
			</span>
		</div>
		<div class="row-actions">
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=codeable_estimate' ) ); ?>&fee_client={{{ data.client_fee }}}"><?php esc_html_e( 'Estimate', 'wpcable' ); ?></a>
			<ul class="color-flag">
			<?php
			foreach ( $color_flags as $flag => $info ) {
				printf(
					'<li data-flag="%1$s" <# if ( "%1$s" == data.flag ) { #> class="current"<# } #>><span class="tooltip autosize small" tabindex="0"><span class="tooltip-text">%2$s</span><div class="color"></div></span></li>',
					esc_attr( $flag ),
					esc_html( $info['label'] )
				);
			}
			?>
			</ul>
		</div>
	</td>
	<td class="col-notes">
		<div class="notes-body">{{{ data.notes_html }}}</div>
	</td>
</ul>
</script>
<style>
<?php
foreach ( $color_flags as $flag => $info ) {
	printf(
		'.flag-%1$s,[data-flag="%1$s"]{--color:%2$s;--bgcolor:%2$s10;}',
		esc_attr( $flag ),
		$info['color']
	);
}
?>
</style>
<script>
window.wpcable=window.wpcable||{};
wpcable.tasks=<?php echo json_encode( $task_list ); ?>;
wpcable.update_task_nonce=<?php echo json_encode( wp_create_nonce( 'wpcable-task' ) ); ?>;
</script>