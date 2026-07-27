<?php
/**
 * ============================================================
 * MODULE REGISTRY
 * ------------------------------------------------------------
 * Declarative definitions that power the generic CRUD engine
 * (App\Controllers\Admin\CrudController) and the admin sidebar.
 * Add a module here and its full Create/Read/Update/Delete UI
 * exists automatically — no new controller needed.
 *
 * Field types: text, textarea, richtext, number, email, url,
 *   date, datetime, select, checkbox, image, file, color, order, hidden
 * ============================================================
 */

declare(strict_types=1);

return [

    /* ---------------- Pages (all page content) ---------------- */
    'pages' => [
        'label' => 'Pages',
        'singular' => 'Page',
        'group' => 'Content',
        'icon' => 'file',
        'table' => 'pages',
        'softDelete' => true,
        'orderBy' => 'title ASC',
        'listColumns' => ['title' => 'Title', 'slug' => 'Slug', 'is_published' => 'Published'],
        'fields' => [
            ['name' => 'title', 'label' => 'Page Title', 'type' => 'text', 'rules' => 'required|max:150'],
            ['name' => 'slug', 'label' => 'Slug (URL)', 'type' => 'text', 'rules' => 'required|max:150', 'hint' => 'e.g. about → about.html'],
            ['name' => 'banner_title', 'label' => 'Banner Heading', 'type' => 'text'],
            ['name' => 'banner_image', 'label' => 'Banner Background', 'type' => 'image'],
            ['name' => 'body_html', 'label' => 'Page Content (HTML)', 'type' => 'richtext', 'rows' => 22],
            ['name' => 'meta_title', 'label' => 'SEO Meta Title', 'type' => 'text', 'group' => 'SEO'],
            ['name' => 'meta_description', 'label' => 'SEO Meta Description', 'type' => 'textarea', 'group' => 'SEO'],
            ['name' => 'meta_keywords', 'label' => 'SEO Keywords', 'type' => 'text', 'group' => 'SEO'],
            ['name' => 'og_image', 'label' => 'Social Share Image', 'type' => 'image', 'group' => 'SEO'],
            ['name' => 'canonical', 'label' => 'Canonical URL', 'type' => 'url', 'group' => 'SEO'],
            ['name' => 'is_published', 'label' => 'Published', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Announcement bar ---------------- */
    'announcements' => [
        'label' => 'Announcement Bar',
        'singular' => 'Announcement',
        'group' => 'Content',
        'icon' => 'megaphone',
        'table' => 'announcements',
        'softDelete' => false,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['lead_text' => 'Text', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'lead_text', 'label' => 'Lead Text', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'strong_text', 'label' => 'Highlighted Text', 'type' => 'text'],
            ['name' => 'link_url', 'label' => 'Link URL', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Hero slider ---------------- */
    'sliders' => [
        'label' => 'Hero Slider',
        'singular' => 'Slide',
        'group' => 'Content',
        'icon' => 'image',
        'table' => 'sliders',
        'softDelete' => false,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['title' => 'Title', 'is_active' => 'Active', 'sort_order' => 'Order'],
        'fields' => [
            ['name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text'],
            ['name' => 'title', 'label' => 'Heading', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'subtitle', 'label' => 'Sub-text', 'type' => 'textarea'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'image'],
            ['name' => 'primary_label', 'label' => 'Primary Button Label', 'type' => 'text'],
            ['name' => 'primary_url', 'label' => 'Primary Button URL', 'type' => 'text'],
            ['name' => 'secondary_label', 'label' => 'Secondary Button Label', 'type' => 'text'],
            ['name' => 'secondary_url', 'label' => 'Secondary Button URL', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Statistics ---------------- */
    'statistics' => [
        'label' => 'Statistics',
        'singular' => 'Statistic',
        'group' => 'Content',
        'icon' => 'chart',
        'table' => 'statistics',
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['label' => 'Label', 'value' => 'Value', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'icon', 'label' => 'Icon (emoji or class)', 'type' => 'text'],
            ['name' => 'value', 'label' => 'Value (number)', 'type' => 'number', 'rules' => 'required|numeric'],
            ['name' => 'suffix', 'label' => 'Suffix (e.g. +, %)', 'type' => 'text'],
            ['name' => 'label', 'label' => 'Label', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Programs ---------------- */
    'programs' => [
        'label' => 'Programs',
        'singular' => 'Program',
        'group' => 'Academics',
        'icon' => 'book',
        'table' => 'programs',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['title' => 'Title', 'badge' => 'Badge', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'badge', 'label' => 'Badge (e.g. Ages 3–5)', 'type' => 'text'],
            ['name' => 'excerpt', 'label' => 'Short Description', 'type' => 'textarea'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'image'],
            ['name' => 'link_url', 'label' => 'Link URL', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Documents (Curriculum & Records) ---------------- */
    'documents' => [
        'label' => 'Document Management',
        'singular' => 'Document',
        'group' => 'Academics',
        'icon' => 'file',
        'table' => 'documents',
        'softDelete' => true,
        'orderBy' => 'category ASC, sort_order ASC, id ASC',
        'listColumns' => ['title' => 'Title', 'category' => 'Category', 'parent' => 'Group', 'is_published' => 'Published', 'is_featured' => 'Featured'],
        'fields' => [
            ['name' => 'title', 'label' => 'Document Title', 'type' => 'text', 'rules' => 'required|max:190'],
            ['name' => 'category', 'label' => 'Category', 'type' => 'select', 'options' => ['academic', 'students', 'teachers', 'administration', 'infrastructure', 'safety', 'cbse', 'pta'], 'rules' => 'required', 'hint' => 'Determines which section of the Curriculum & Documents page it appears in.'],
            ['name' => 'parent', 'label' => 'Parent Group (optional)', 'type' => 'text', 'hint' => 'Sub-group heading, e.g. Curriculum, Book List, Recognition, Affiliation, Infrastructure.'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
            ['name' => 'file', 'label' => 'Document File (PDF or Image)', 'type' => 'file'],
            ['name' => 'thumbnail', 'label' => 'Thumbnail (optional)', 'type' => 'image'],
            ['name' => 'doc_date', 'label' => 'Document Date / Session', 'type' => 'date'],
            ['name' => 'sort_order', 'label' => 'Display Order', 'type' => 'order'],
            ['name' => 'is_published', 'label' => 'Published', 'type' => 'checkbox', 'default' => 1],
            ['name' => 'is_featured', 'label' => 'Featured', 'type' => 'checkbox'],
        ],
    ],

    /* ---------------- Academic Calendar pages ---------------- */
    'calendar_pages' => [
        'label' => 'Academic Calendar',
        'singular' => 'Calendar Page',
        'group' => 'Academics',
        'icon' => 'calendar',
        'table' => 'calendar_pages',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC, id ASC',
        'listColumns' => ['title' => 'Title', 'session' => 'Session', 'is_published' => 'Published', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'rules' => 'required|max:120'],
            ['name' => 'image', 'label' => 'Calendar Page Image', 'type' => 'image', 'rules' => 'required'],
            ['name' => 'session', 'label' => 'Academic Session', 'type' => 'text', 'default' => '2026-2027'],
            ['name' => 'sort_order', 'label' => 'Display Order', 'type' => 'order'],
            ['name' => 'is_published', 'label' => 'Published', 'type' => 'checkbox', 'default' => 1],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Notices & Circulars ---------------- */
    'notices' => [
        'label' => 'Notices & Circulars',
        'singular' => 'Notice',
        'group' => 'Content',
        'icon' => 'bell',
        'table' => 'notices',
        'softDelete' => true,
        'orderBy' => 'is_pinned DESC, publish_date DESC',
        'listColumns' => ['title' => 'Title', 'category' => 'Category', 'is_featured' => 'Featured', 'is_pinned' => 'Pinned'],
        'fields' => [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'category', 'label' => 'Category', 'type' => 'select', 'options' => ['Events', 'Academics', 'Sports', 'Circular', 'Admissions']],
            ['name' => 'excerpt', 'label' => 'Summary', 'type' => 'textarea'],
            ['name' => 'body_html', 'label' => 'Full Content', 'type' => 'richtext'],
            ['name' => 'attachment', 'label' => 'Attachment (PDF)', 'type' => 'file'],
            ['name' => 'publish_date', 'label' => 'Publish Date', 'type' => 'date', 'rules' => 'required'],
            ['name' => 'expiry_date', 'label' => 'Expiry Date', 'type' => 'date'],
            ['name' => 'is_featured', 'label' => 'Featured', 'type' => 'checkbox'],
            ['name' => 'is_pinned', 'label' => 'Pin to Top', 'type' => 'checkbox'],
        ],
    ],

    /* ---------------- Downloads ---------------- */
    'downloads' => [
        'label' => 'Downloads',
        'singular' => 'Download',
        'group' => 'Content',
        'icon' => 'download',
        'table' => 'downloads',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['title' => 'Title', 'category' => 'Category', 'download_count' => 'Downloads'],
        'fields' => [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
            ['name' => 'category', 'label' => 'Category', 'type' => 'text'],
            ['name' => 'file', 'label' => 'File (PDF)', 'type' => 'file'],
            ['name' => 'icon', 'label' => 'Icon (emoji)', 'type' => 'text', 'default' => '📄'],
            ['name' => 'is_featured', 'label' => 'Featured', 'type' => 'checkbox'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
        ],
    ],

    /* ---------------- Gallery albums ---------------- */
    'gallery_albums' => [
        'label' => 'Gallery Albums',
        'singular' => 'Album',
        'group' => 'Media & Gallery',
        'icon' => 'folder',
        'table' => 'gallery_albums',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['title' => 'Title', 'category' => 'Category'],
        'fields' => [
            ['name' => 'title', 'label' => 'Album Title', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'category', 'label' => 'Category', 'type' => 'text'],
            ['name' => 'cover_image', 'label' => 'Cover Image', 'type' => 'image'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
        ],
    ],

    /* ---------------- Gallery images ---------------- */
    'gallery_images' => [
        'label' => 'Gallery Images',
        'singular' => 'Image',
        'group' => 'Media & Gallery',
        'icon' => 'image',
        'table' => 'gallery_images',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['title' => 'Title', 'category' => 'Category', 'is_featured' => 'Featured'],
        'fields' => [
            ['name' => 'title', 'label' => 'Title / Alt Text', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'album_id', 'label' => 'Album', 'type' => 'select', 'optionsFrom' => ['table' => 'gallery_albums', 'value' => 'id', 'label' => 'title']],
            ['name' => 'category', 'label' => 'Category (filter)', 'type' => 'text'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'image', 'rules' => 'required'],
            ['name' => 'is_featured', 'label' => 'Featured', 'type' => 'checkbox'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
        ],
    ],

    /* ---------------- Reviews ---------------- */
    'reviews' => [
        'label' => 'Reviews',
        'singular' => 'Review',
        'group' => 'People',
        'icon' => 'star',
        'table' => 'reviews',
        'softDelete' => true,
        'orderBy' => 'created_at DESC',
        'listColumns' => ['name' => 'Name', 'rating' => 'Stars', 'is_approved' => 'Approved'],
        'fields' => [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'designation', 'label' => 'Designation', 'type' => 'text'],
            ['name' => 'rating', 'label' => 'Rating (1-5)', 'type' => 'select', 'options' => ['5', '4', '3', '2', '1'], 'default' => '5'],
            ['name' => 'avatar', 'label' => 'Photo', 'type' => 'image'],
            ['name' => 'review', 'label' => 'Review Text', 'type' => 'textarea', 'rules' => 'required'],
            ['name' => 'is_approved', 'label' => 'Approved', 'type' => 'checkbox'],
        ],
    ],

    /* ---------------- Testimonials ---------------- */
    'testimonials' => [
        'label' => 'Testimonials',
        'singular' => 'Testimonial',
        'group' => 'People',
        'icon' => 'quote',
        'table' => 'testimonials',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['name' => 'Name', 'role' => 'Role', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'role', 'label' => 'Role', 'type' => 'text'],
            ['name' => 'rating', 'label' => 'Rating (1-5)', 'type' => 'select', 'options' => ['5', '4', '3', '2', '1'], 'default' => '5'],
            ['name' => 'avatar', 'label' => 'Photo', 'type' => 'image'],
            ['name' => 'quote', 'label' => 'Quote', 'type' => 'textarea', 'rules' => 'required'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Staff / Leadership ---------------- */
    'staff' => [
        'label' => 'Staff & Leadership',
        'singular' => 'Member',
        'group' => 'People',
        'icon' => 'users',
        'table' => 'staff',
        'softDelete' => true,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['name' => 'Name', 'role' => 'Role', 'category' => 'Type'],
        'fields' => [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'role', 'label' => 'Role / Designation', 'type' => 'text'],
            ['name' => 'category', 'label' => 'Type', 'type' => 'select', 'options' => ['Leadership', 'Teacher', 'Staff']],
            ['name' => 'photo', 'label' => 'Photo', 'type' => 'image'],
            ['name' => 'bio', 'label' => 'Bio / Message', 'type' => 'richtext'],
            ['name' => 'quote', 'label' => 'Pull Quote / Lead', 'type' => 'textarea'],
            ['name' => 'signature', 'label' => 'Signature Image', 'type' => 'image'],
            ['name' => 'socials', 'label' => 'Social Links (comma-separated URLs)', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- FAQ ---------------- */
    'faqs' => [
        'label' => 'FAQ',
        'singular' => 'FAQ',
        'group' => 'Content',
        'icon' => 'help',
        'table' => 'faqs',
        'softDelete' => false,
        'orderBy' => 'sort_order ASC',
        'listColumns' => ['question' => 'Question', 'page' => 'Page', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'question', 'label' => 'Question', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'answer', 'label' => 'Answer', 'type' => 'textarea', 'rules' => 'required'],
            ['name' => 'page', 'label' => 'Page', 'type' => 'text', 'default' => 'admissions'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- CTA blocks ---------------- */
    'cta_blocks' => [
        'label' => 'CTA Sections',
        'singular' => 'CTA',
        'group' => 'Content',
        'icon' => 'flag',
        'table' => 'cta_blocks',
        'softDelete' => false,
        'orderBy' => 'id DESC',
        'listColumns' => ['identifier' => 'Key', 'heading' => 'Heading', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'identifier', 'label' => 'Key (e.g. home_cta)', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'heading', 'label' => 'Heading', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'subtext', 'label' => 'Sub-text', 'type' => 'textarea'],
            ['name' => 'primary_label', 'label' => 'Primary Button', 'type' => 'text'],
            ['name' => 'primary_url', 'label' => 'Primary URL', 'type' => 'text'],
            ['name' => 'secondary_label', 'label' => 'Secondary Button', 'type' => 'text'],
            ['name' => 'secondary_url', 'label' => 'Secondary URL', 'type' => 'text'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'image'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Content blocks (section text) ---------------- */
    'content_blocks' => [
        'label' => 'Section Content',
        'singular' => 'Content Block',
        'group' => 'Content',
        'icon' => 'blocks',
        'table' => 'content_blocks',
        'softDelete' => false,
        'orderBy' => 'page ASC, sort_order ASC',
        'listColumns' => ['page' => 'Page', 'block_key' => 'Section', 'title' => 'Title', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'page', 'label' => 'Page', 'type' => 'text', 'rules' => 'required', 'hint' => 'e.g. index, about'],
            ['name' => 'block_key', 'label' => 'Section Key', 'type' => 'text', 'rules' => 'required', 'hint' => 'e.g. hero, welcome, programs'],
            ['name' => 'eyebrow', 'label' => 'Eyebrow / Label', 'type' => 'text'],
            ['name' => 'title', 'label' => 'Title', 'type' => 'text'],
            ['name' => 'subtitle', 'label' => 'Subtitle', 'type' => 'text'],
            ['name' => 'body', 'label' => 'Body Text (HTML allowed)', 'type' => 'richtext', 'rows' => 8],
            ['name' => 'image', 'label' => 'Image', 'type' => 'image'],
            ['name' => 'link_label', 'label' => 'Button Label', 'type' => 'text'],
            ['name' => 'link_url', 'label' => 'Button URL', 'type' => 'text'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Decorations (floating shapes) ---------------- */
    'decorations' => [
        'label' => 'Decorative Elements',
        'singular' => 'Decoration',
        'group' => 'Appearance',
        'icon' => 'shapes',
        'table' => 'decorations',
        'softDelete' => false,
        'orderBy' => 'section ASC, sort_order ASC',
        'listColumns' => ['section' => 'Section', 'shape' => 'Shape', 'color' => 'Color', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'section', 'label' => 'Section', 'type' => 'select', 'options' => ['hero', 'cta', 'stats', 'about', 'footer'], 'rules' => 'required'],
            ['name' => 'shape', 'label' => 'Shape', 'type' => 'select', 'options' => ['blob', 'circle', 'wave', 'line', 'image'], 'default' => 'blob'],
            ['name' => 'color', 'label' => 'Color (token)', 'type' => 'select', 'options' => ['primary', 'accent', 'ink', 'primary/40', 'accent/40', 'white/20']],
            ['name' => 'position', 'label' => 'Position (Tailwind classes)', 'type' => 'text', 'hint' => 'e.g. left-[-120px] top-24'],
            ['name' => 'size', 'label' => 'Size (Tailwind classes)', 'type' => 'text', 'hint' => 'e.g. h-80 w-80'],
            ['name' => 'opacity', 'label' => 'Opacity (0-100)', 'type' => 'number', 'default' => 40],
            ['name' => 'animation', 'label' => 'Animation', 'type' => 'select', 'options' => ['none', 'floaty', 'spin-slow', 'fade-up']],
            ['name' => 'image', 'label' => 'Custom Image (optional)', 'type' => 'image'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'order'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],

    /* ---------------- Users (admin only) ---------------- */
    'users' => [
        'label' => 'Users',
        'singular' => 'User',
        'group' => 'System',
        'icon' => 'user',
        'table' => 'users',
        'softDelete' => true,
        'adminOnly' => true,
        'orderBy' => 'name ASC',
        'listColumns' => ['name' => 'Name', 'email' => 'Email', 'role' => 'Role', 'is_active' => 'Active'],
        'fields' => [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'rules' => 'required'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'rules' => 'required|email'],
            ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'options' => ['admin', 'editor'], 'default' => 'editor'],
            ['name' => 'password', 'label' => 'Password (leave blank to keep)', 'type' => 'password'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
        ],
    ],
];
