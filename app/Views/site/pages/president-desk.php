<?php
use App\Core\View;
echo View::render('site/pages/_leader', [
    'leader' => $leader ?? null,
    'page' => $page,
    'eyebrow' => 'Message from the President',
    // Opening quote block
    'openingQuote' => 'Education is the most powerful gift we can give a child.',
    'openingQuoteAttr' => 'Prof. Mr. Dinesh Ji Channawar',
    // Highlight strip — provided wording, used verbatim
    'highlightLabel' => 'Our Mission',
    'highlightText' => 'Our mission is to nurture responsible, compassionate and globally aware citizens.',
    // Complete President's message — EXACT wording, split into readable sections.
    'sections' => [
        [
            'icon' => 'fa-bullseye',
            'heading' => 'Our Mission',
            'body' => '<p>Our Mission: We aspire to craft socially conscious and responsible individuals. Our mission is to create torch bearers. We aim to edify students about the worth of hard work, justice and dignity. Our mission is dedicated to fulfil every child’s educational and developmental needs in an utterly safe and immensely caring environment, conducive and catalytic to learning as well as teaching. We aim and aspire to mentor and create, responsible, global citizen who should posses adaptable understanding, compassion and acceptance of differences and variety in the Global society. We strive to ensure that every child in our care is empowered to make independent rational choices and encouraged to contribute to our community and country.</p>',
        ],
        [
            'icon' => 'fa-children',
            'heading' => 'Student-Centric Learning',
            'body' => '<p>We are a student’s school, because we believe if you let students learn by their ways they learn better. We are, as our valuable parents describe us,” the school that children love to go and hate to miss in the mornings.” The warmth of our school is apparent the moment you walk through the corridors. Our classrooms are seldom quiet, because they are filled with activity all through the day. Our teachers teach with enthusiasm and learning is a joyful experience for our children. Our children learn together, because we have learnt through experience that a collaborative environment is the most fertile one for learning. We are a happy harmoniously learning community, flourishing in an extraordinary facility which is unique to Wardha.</p>',
        ],
        [
            'icon' => 'fa-earth-asia',
            'heading' => 'Building Future Citizens',
            'body' => '<p>We have striven to build outstanding facilities and resource because we value our children and believe that they deserve only the best. This ideology permeates our campus and is reflected in our teachers and staff members, who, with unflinching faith and dedication partake and revel in nurturing the children. Together we strive to create happy citizens ready to lead and make a difference to build a community of learners making our world sustainable.</p>',
        ],
    ],
    'defaults' => [
        'name' => 'Prof. Mr. Dinesh Ji Channawar', 'role' => 'President',
        'heading' => 'A Message From Our President',
        'quote' => 'Education is the most powerful gift we can give a child.',
        'photo' => placeholder('portrait'),
    ],
]);
