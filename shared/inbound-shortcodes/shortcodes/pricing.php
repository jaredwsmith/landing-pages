<?php
/**
*   Pricing Tables Shortcode
*/

/* 	Shortcode generator config
 * 	----------------------------------------------------- */
	$shortcodes_config['pricing'] = array(
		'no_preview' => true,
		'options' => array(
			'column' => array(
				'name' => __('Column', INBOUND_LABEL),
				'desc' => __('Select the column.', INBOUND_LABEL),
				'type' => 'select',
				'options' => array(
					'2' => __('2 Columns', INBOUND_LABEL),
					'3' => __('3 Columns', INBOUND_LABEL),
					'4' => __('4 Columns', INBOUND_LABEL),
					'5' => __('5 Columns', INBOUND_LABEL)
				),
				'std' => '4',
			)
		),
		'child' => array(
			'options' => array(
				'featured' => array(
					'name' => __('Featured Plan',  INBOUND_LABEL),
					'desc' => __('Check to set this plan as featured', INBOUND_LABEL),
					'type' => 'checkbox',
					'std' => '0',
				),
				'title' => array(
					'name' => __('Plan Title', INBOUND_LABEL),
					'desc' => __('Enter the plan title.', INBOUND_LABEL),
					'type' => 'text',
					'std' => ''
				),
				'price' => array(
					'name' => __('Plan Price', INBOUND_LABEL),
					'desc' => __('Enter the plan price.', INBOUND_LABEL),
					'type' => 'text',
					'std' => ''
				),
				'term' => array(
					'name' => __('Plan Term', INBOUND_LABEL),
					'desc' => __('Enter the plan term. e.g : "per month", "per year" etc.', INBOUND_LABEL),
					'type' => 'text',
					'std' => ''
				),
				'button_text' => array(
					'name' => __('Plan Button Text', INBOUND_LABEL),
					'desc' => __('Enter the button text label.', INBOUND_LABEL),
					'type' => 'text',
					'std' => ''
				),
				'button_link' => array(
					'name' => __('Plan Button Link', INBOUND_LABEL),
					'desc' => __('Enter the button link destination URL.', INBOUND_LABEL),
					'type' => 'text',
					'std' => ''
				),
				'content' => array(
					'name' => __('Plan Content',  INBOUND_LABEL),
					'desc' => __('Put the content here.',  INBOUND_LABEL),
					'type' => 'textarea',
					'std' => ''
				)
			),
			'shortcode' => '[plan featured="{{featured}}" title="{{title}}" price="{{price}}" term="{{term}}" button_text="{{button_text}}" button_link="{{button_link}}"]{{content}}[/plan]',
			'clone' => __('Add More Testimony',  INBOUND_LABEL )
		),
		'shortcode' => '[pricing column="{{column}}"]{{child}}[/pricing]',
		'popup_title' => __('Insert Pricing Shortcode',  INBOUND_LABEL)
	);

/* 	Page builder module config
 * 	----------------------------------------------------- */
	$freshbuilder_modules['pricing'] = array(
		'name' => __('Pricing Table', INBOUND_LABEL),
		'size' => 'one_full',
		'options' => array(
			'column' => array(
				'name' => __('Column', INBOUND_LABEL),
				'desc' => __('Select the column.', INBOUND_LABEL),
				'type' => 'select',
				'options' => array(
					'2' => __('2 Columns', INBOUND_LABEL),
					'3' => __('3 Columns', INBOUND_LABEL),
					'4' => __('4 Columns', INBOUND_LABEL),
					'5' => __('5 Columns', INBOUND_LABEL)
				),
				'std' => '4',
				'class' => '',
				'is_content' => 0
			)
		),
		'child' => array(
			'featured' => array(
				'name' => __('Featured Plan', INBOUND_LABEL),
				'desc' => __('Check to set this plan as featured', INBOUND_LABEL),
				'type' => 'checkbox',
				'std' => '0',
				'class' => '',
				'is_content' => 0
			),
			'title' => array(
				'name' => __('Plan Title', INBOUND_LABEL),
				'desc' => __('Enter the plan title.', INBOUND_LABEL),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'price' => array(
				'name' => __('Plan Price', INBOUND_LABEL),
				'desc' => __('Enter the plan price.', INBOUND_LABEL),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'term' => array(
				'name' => __('Plan Term', INBOUND_LABEL),
				'desc' => __('Enter the plan term. e.g : "per month", "per year" etc.', INBOUND_LABEL),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'button_text' => array(
				'name' => __('Plan Button Text', INBOUND_LABEL),
				'desc' => __('Enter the button text label.', INBOUND_LABEL),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'button_link' => array(
				'name' => __('Plan Button Link', INBOUND_LABEL),
				'desc' => __('Enter the button link destination URL.', INBOUND_LABEL),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'content' => array(
				'name' => __('Plan Content', INBOUND_LABEL),
				'desc' => __('Put the content here.', INBOUND_LABEL),
				'type' => 'textarea',
				'class' => '',
				'is_content' => 1
			)
		),
		'child_code' => 'plan'
	);

/* 	Add shortcode
 * 	----------------------------------------------------- */
	add_shortcode('pricing', 'inbound_shortcode_pricing');

	function inbound_shortcode_pricing( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'column' => '3'
		), $atts));

		$grid = ' grid full';
		if ($column == '2') $grid = ' grid one-half';
		if ($column == '3') $grid = ' grid one-third';
		if ($column == '4') $grid = ' grid one-fourth';
		if ($column == '5') $grid = ' grid one-fifth';
		$out = '';

		if (!preg_match_all("/(.?)\[(plan)\b(.*?)(?:(\/))?\](?:(.+?)\[\/plan\])?(.?)/s", $content, $matches)) {

			return do_shortcode($content);

		} else {

			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			}

			$out .= '<div class="pricing clearfix">';

			for($i = 0; $i < count($matches[0]); $i++) {
				$featured = ( $matches[3][$i]['featured'] == '1') ? ' featured' : '';

	            $out .= '<div class="plan '. $grid . $featured .'">';
		            $out .= '<div class="plan-header">';
		            	$out .= '<h2>' . $matches[3][$i]['title'] . '</h2>';
	                $out .= '</div>';

		            $out .= '<div class="plan-price">';
		            	$out .= '<strong>'. $matches[3][$i]['price'] .'</strong>';
		            	$out .= '<span>'. $matches[3][$i]['term'] .'</span>';
	                $out .= '</div>';

		            $out .= '<div class="plan-content">';
		            	$out .= do_shortcode(trim($matches[5][$i]));
	                $out .= '</div>';

		            $out .= '<div class="plan-footer">';
		            	$out .= '<a class="button" href="'. $matches[3][$i]['button_link'] .'">'. $matches[3][$i]['button_text'] .'</a>';
	                $out .= '</div>';
                $out .= '</div>';
            }

			$out .= '</div>';
		}

		return $out;
	}