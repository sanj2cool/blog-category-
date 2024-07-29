<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Post_Categories_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'post_categories_grid';
    }

    public function get_title() {
        return __('Post Categories Grid', 'custom-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'custom-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __('Columns', 'custom-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => __('1', 'custom-elementor-widgets'),
                    '2' => __('2', 'custom-elementor-widgets'),
                    '3' => __('3', 'custom-elementor-widgets'),
                    '4' => __('4', 'custom-elementor-widgets'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns = $settings['columns'];

        $categories = get_categories();

        if (!empty($categories)) {
            echo '<div class="post-categories-grid" style="display: grid; grid-template-columns: repeat(' . esc_attr($columns) . ', 1fr); gap: 20px;">';

            foreach ($categories as $category) {
                $image = get_field('f_images', 'category_' . $category->term_id);
                $image_url = $image ? $image['url'] : '';
                $background_image = $image_url ? 'style="background-image: url(' . esc_url($image_url) . ');"' : '';
                echo '<div class="category-item" ' . $background_image . '>';
                echo '<a href="' . get_category_link($category->term_id) . '">';
                echo '<h2>' . esc_html($category->name) . '</h2>';
                echo '</a>';
                echo '</div>';
            }

            echo '</div>';
        }
    }
    /**
    protected function _content_template() {
        ?>
        <#
        var columns = settings.columns;

        var categories = <?php echo json_encode(get_categories()); ?>;

        if (categories.length) {
            #>
            <div class="post-categories-grid" style="display: grid; grid-template-columns: repeat({{ columns }}, 1fr); gap: 20px;">
                <# _.each(categories, function(category) {
                    var image = wp.data.select('core').getEntityRecord('taxonomy', 'category', category.term_id).acf.f_images;
                    var imageUrl = image ? image.url : '';
                    var backgroundImage = imageUrl ? 'style="background-image: url(' + imageUrl + ');"' : '';
                #>
                <div class="category-item" {{{ backgroundImage }}}>
                    <a href="{{ category.link }}">
                        <h2>{{ category.name }}</h2>
                    </a>
                </div>
                <# }); #>
            </div>
        <#
        }
        #>
        <?php
    } **/
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Post_Categories_Grid_Widget());
?>
