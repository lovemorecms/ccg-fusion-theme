<?php
/**
 * Primary navigation structure (dev-maintained; mirrors navNewCcgMenu.ts).
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param string $path Site path (may include hash).
 */
function ccg_nav_url( $path = '#' ) {
	if ( '#' === $path || '' === $path ) {
		return '#';
	}
	if ( 0 === strpos( $path, 'http' ) ) {
		return $path;
	}
	$hash = '';
	if ( false !== strpos( $path, '#' ) ) {
		list( $path, $hash ) = explode( '#', $path, 2 );
	}
	$url = home_url( user_trailingslashit( $path ) );
	return $hash ? $url . '#' . $hash : $url;
}

/**
 * @return array{label:string,href:string}
 */
function ccg_nav_link( $label, $href = '#' ) {
	return array(
		'label' => $label,
		'href'  => ccg_nav_url( $href ),
	);
}

/**
 * @return array<int, array{label:string,href:string}>
 */
function ccg_nav_list( ...$labels ) {
	$links = array();
	foreach ( $labels as $label ) {
		$links[] = ccg_nav_link( $label );
	}
	return $links;
}

/**
 * @return array{title:string,links:array}
 */
function ccg_nav_column( $title, ...$labels ) {
	return array(
		'title' => $title,
		'links' => ccg_nav_list( ...$labels ),
	);
}

/**
 * @param array<int, array{label:string,href:string}> $links
 * @return array<int, array{label:string,href:string}>
 */
function ccg_nav_sort_links( $links, $preserve_order = false ) {
	if ( $preserve_order ) {
		return $links;
	}
	usort(
		$links,
		function ( $a, $b ) {
			return strcasecmp( $a['label'], $b['label'] );
		}
	);
	return $links;
}

/**
 * @param array $panel
 * @return array
 */
function ccg_nav_sort_panel( $panel, $category_id = '' ) {
	if ( ( $panel['type'] ?? '' ) === 'empty' ) {
		return $panel;
	}
	if ( in_array( $panel['type'], array( 'list', 'cards' ), true ) ) {
		$preserve = 'fusion-toolkit' === $category_id;
		$panel['links'] = ccg_nav_sort_links( $panel['links'], $preserve );
		return $panel;
	}
	if ( 'columns' === ( $panel['type'] ?? '' ) ) {
		foreach ( $panel['columns'] as $i => $col ) {
			$panel['columns'][ $i ]['links'] = ccg_nav_sort_links( $col['links'] );
		}
		usort(
			$panel['columns'],
			function ( $a, $b ) {
				return strcasecmp( $a['title'], $b['title'] );
			}
		);
	}
	return $panel;
}

/**
 * @param array<int, array> $items
 * @return array<int, array>
 */
function ccg_nav_sort_menu_items( $items ) {
	$category_orders = array(
		'learn'        => array(
			'knowledge-center'     => 0,
			'training-enablement'  => 1,
			'customer-roadmap'     => 2,
		),
		'explore'      => array(
			'platforms'        => 0,
			'fusion-toolkit' => 1,
			'shared-services'  => 2,
		),
		'get-started'  => array(
			'new-onboarding' => 0,
			'migrate'        => 1,
		),
	);

	foreach ( $items as $idx => $item ) {
		$order_map = $category_orders[ $item['id'] ] ?? null;
		$cats      = $item['categories'];

		foreach ( $cats as $cidx => $cat ) {
			if ( 'about' === $item['id'] && 'about-hybrid-cloud' === $cat['id'] ) {
				continue;
			}
			$cats[ $cidx ]['panel'] = ccg_nav_sort_panel( $cat['panel'], $cat['id'] );
		}

		if ( $order_map ) {
			usort(
				$cats,
				function ( $a, $b ) use ( $order_map ) {
					$ra = $order_map[ $a['id'] ] ?? PHP_INT_MAX;
					$rb = $order_map[ $b['id'] ] ?? PHP_INT_MAX;
					return $ra <=> $rb;
				}
			);
		} else {
			usort(
				$cats,
				function ( $a, $b ) {
					return strcasecmp( $a['label'], $b['label'] );
				}
			);
		}

		$items[ $idx ]['categories'] = $cats;
	}

	return $items;
}

/**
 * Platform links for Explore → Platforms.
 *
 * @return array<int, array{label:string,href:string}>
 */
function ccg_nav_platform_links() {
	$platforms = array(
		array( 'AWS Commercial', 'aws-commercial' ),
		array( 'AWS Outposts', 'aws-outposts' ),
		array( 'Azure Commercial', 'azure-commercial' ),
		array( 'Google Cloud Platform', 'google-cloud-platform' ),
		array( 'Oracle Cloud Infrastructure', 'oracle-cloud-infrastructure' ),
		array( 'Oracle at Customer', 'oracle-at-customer' ),
	);
	$links = array();
	foreach ( $platforms as $p ) {
		$links[] = ccg_nav_link( $p[0], '/explore/platforms/' . $p[1] );
	}
	return ccg_nav_sort_links( $links );
}

/**
 * Fusion Toolkit links (fixed order).
 *
 * @return array<int, array{label:string,href:string}>
 */
function ccg_nav_fusion_toolkit_links() {
	$base = '/explore/fusion-toolkit';
	$links = array( ccg_nav_link( 'Overview', $base . '#overview' ) );
	$products = array( 'BaseCamp', 'Helix', 'Lens', 'Match' );
	foreach ( array( 'basecamp', 'helix', 'lens', 'match' ) as $i => $id ) {
		$links[] = ccg_nav_link( $products[ $i ], $base . '#' . $id );
	}
	return $links;
}

/**
 * @return array<int, array>
 */
function ccg_get_nav_menu_items() {
	static $items = null;
	if ( null !== $items ) {
		return $items;
	}

	$items = ccg_nav_sort_menu_items(
		array(
			array(
				'id'         => 'about',
				'label'      => 'About',
				'href'       => ccg_nav_url( '/about/program-overview' ),
				'categories' => array(
					array(
						'id'    => 'about-hybrid-cloud',
						'label' => 'About Hybrid Cloud',
						'href'  => ccg_nav_url( '/about/program-overview' ),
						'panel' => array(
							'type'  => 'list',
							'links' => array(
								ccg_nav_link( 'Program Overview', '/about/program-overview' ),
								ccg_nav_link( 'Benefits', '/about/program-overview' ),
								ccg_nav_link( 'Success Stories', '/about/program-overview' ),
								ccg_nav_link( 'Contact Us', '/about/program-overview' ),
							),
						),
					),
				),
			),
			array(
				'id'         => 'explore',
				'label'      => 'Explore',
				'href'       => ccg_nav_url( '/explore' ),
				'categories' => array(
					array(
						'id'    => 'platforms',
						'label' => 'Platforms',
						'href'  => ccg_nav_url( '/explore#platforms' ),
						'panel' => array(
							'type'  => 'list',
							'links' => ccg_nav_platform_links(),
						),
					),
					array(
						'id'    => 'fusion-toolkit',
						'label' => 'Fusion Toolkit',
						'href'  => ccg_nav_url( '/explore/fusion-toolkit' ),
						'panel' => array(
							'type'  => 'list',
							'links' => ccg_nav_fusion_toolkit_links(),
						),
					),
					array(
						'id'    => 'shared-services',
						'label' => 'Shared Services',
						'href'  => ccg_nav_url( '/explore' ),
						'panel' => array(
							'type'  => 'list',
							'links' => ccg_nav_list(
								'Compute',
								'Development Support',
								'Financial Operations (FinOps)',
								'Network',
								'Operations & Maintenance',
								'Platform',
								'Security & Compliance',
								'Storage',
								'Solutions Engineering',
								'User Access'
							),
						),
					),
				),
			),
			array(
				'id'         => 'learn',
				'label'      => 'Learn',
				'href'       => ccg_nav_url( '/learn/knowledge-center' ),
				'categories' => array(
					array(
						'id'    => 'knowledge-center',
						'label' => 'Knowledge Center',
						'href'  => ccg_nav_url( '/learn/knowledge-center' ),
						'panel' => array(
							'type'    => 'columns',
							'columns' => array(
								ccg_nav_column(
									'ARCHITECTURE & INFRASTRUCTURE',
									'CMS Hybrid Cloud Architecture',
									'Cloud Governance',
									'Containers',
									'Storage',
									'User Access',
									'Platform'
								),
								ccg_nav_column(
									'COMPUTING & DEVOPS',
									'Gold Image',
									'Patching',
									'EC2 Instances',
									'DevOps',
									'Distributed Load Testing (DLTA)',
									'JFrog Platform',
									'Selenium Box',
									'Snyk',
									'SonarQube',
									'Testing as a Service (TaaS)'
								),
								ccg_nav_column(
									'MONITORING',
									'CMS Hybrid Cloud Observability',
									'CMS Enterprise Situational Awareness',
									'Introduction to Continuous Diagnostics and Mitigation',
									'Best practices for logging application development',
									'Datadog',
									'New Relic',
									'Site Reliability Engineering (SRE)',
									'SLO/SLI',
									'Software Asset Management',
									'Splunk ITSI',
									'Splunk'
								),
								ccg_nav_column(
									'NETWORKING & SECURITY',
									'CMSNet/WAN',
									'IPv6 Migration',
									'VPC',
									'Zscaler',
									'Security & Compliance Overview',
									'Compliance',
									'Adaptive Capabilities Testing (ACT)',
									'AWS Commercial account compliance',
									'AWS Security Hub',
									'AWS Backup',
									'Azure Backup',
									'Cloud Protection Manager (CPM)',
									'Introduction to DNS Requests',
									'Encryption',
									'Firewall',
									'Tenable Security Center',
									'Trend Micro Deep Security',
									'Zero Trust',
									'Site reliability',
									'Incident Management'
								),
							),
						),
					),
					array(
						'id'    => 'training-enablement',
						'label' => 'Training & Enablement',
						'href'  => ccg_nav_url( '/learn/training-enablement' ),
						'panel' => array(
							'type'    => 'columns',
							'columns' => array(
								ccg_nav_column(
									'CLOUD PLATFORM',
									'AWS Training',
									'Google Cloud Platform Training',
									'Microsoft Azure Training',
									'CloudTamer Training',
									'Datadog Training',
									'Snyk training',
									'Splunk training'
								),
								ccg_nav_column( 'AGILE TOOLS', 'Confluence Training', 'Jira Training' ),
								ccg_nav_column(
									'HYBRID CLOUD HOSTING SERVICES SELF-PACED LEARNING',
									'CMS Hybrid Cloud Ecosystem',
									'CMS Hybrid Cloud Computer Based Learning',
									'CMS CACHE IaaS Fundamentals'
								),
								ccg_nav_column( 'HYBRID CLOUD PROGRAM SESSIONS', 'Fireside Chats' ),
							),
						),
					),
					array(
						'id'    => 'customer-roadmap',
						'label' => 'Customer Roadmap',
						'href'  => ccg_nav_url( '/learn/initiatives' ),
						'panel' => array(
							'type'    => 'columns',
							'columns' => array(
								ccg_nav_column(
									'FINANCIAL OPERATIONS',
									'Financial Management',
									'Cost Optimization',
									'Working Together',
									'FinOps Engineering',
									'Tools & Resources',
									'Support'
								),
								ccg_nav_column(
									'COST TOOLS',
									'Cost Management Center',
									'How contracting works on CMS Hybrid Cloud',
									'Repricing and funding for CY2',
									'Introduction to Cost Estimation Tool (CET)',
									'Getting started with Cost Estimation Tool (CET)',
									'Using Cost Estimate Templates',
									'Cost Estimation Tool (CET) Workflow Enhancement Guide',
									'VIEW',
									'Estimate at Completion (EAC) 2.0 Dashboard',
									'EAC 2.0 access request',
									'Introduction to AWS Compute Optimizer',
									'Introduction to Amazon EC2 Reserved Instances',
									'Cloud cost saving with AWS Savings Plans',
									'Analyzing AWS cloud costs with Cost Explorer',
									'Understanding AWS Budgets and alerts',
									'AWS Cost Optimization Checklist',
									'CMS Hybrid Cloud cost allocation tags',
									'Azure Cost Optimization Checklist'
								),
								ccg_nav_column(
									'CLOUD CONSUMPTION',
									'Cloud Consumption Playbook: Improving consumption effectiveness',
									'Best practices for effective Cloud Consumption',
									'Compute service area',
									'Storage service area',
									'Database service area',
									'Other service area',
									'Unlocking the value of cloud at CMS',
									'Provisioning guidelines',
									'Utilization guidelines',
									'Savings plans guidelines',
									'Next gen services guidelines',
									'Cloud Consumption Consultations'
								),
							),
						),
					),
				),
			),
			array(
				'id'         => 'get-started',
				'label'      => 'Get Started',
				'href'       => ccg_nav_url( '/#pathways' ),
				'categories' => array(
					array(
						'id'    => 'new-onboarding',
						'label' => 'New Onboarding',
						'href'  => ccg_nav_url( '/#pathways' ),
						'panel' => array(
							'type'  => 'list',
							'links' => ccg_nav_list(
								'Onboarding Stages',
								'Onboarding Process Key Activities and Supporting Team'
							),
						),
					),
					array(
						'id'    => 'migrate',
						'label' => 'Migrate',
						'href'  => ccg_nav_url( '/#pathways' ),
						'panel' => array(
							'type'  => 'list',
							'links' => ccg_nav_list(
								'Accessing CMS Enterprise Confluence',
								'Application production prerequisites',
								'CMS Hybrid Cloud GitHub repository list',
								'Decommissioning your application',
								'Managing CMS Hybrid Cloud GitHub repositories',
								'Sandbox acceptable use policy',
								'Using CMS starter apps',
								'AWS Base'
							),
						),
					),
				),
			),
		)
	);

	return $items;
}
