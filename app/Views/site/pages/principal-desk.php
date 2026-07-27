<?php
use App\Core\View;
echo View::render('site/pages/_leader', [
    'leader' => $leader ?? null,
    'page' => $page,
    'eyebrow' => 'Message from the Principal',
    // Opening quote block — provided verbatim
    'openingQuote' => 'Develop a passion for learning. If you do, you will never cease to grow.',
    'openingQuoteAttr' => "Anthony J. D'Angelo",
    // Highlight strip — provided wording, used verbatim (book icon per brief)
    'highlightLabel' => 'Our Belief',
    'highlightText' => 'Education is the harmonious development of Hand, Head and Heart.',
    'highlightIcon' => 'fa-book',
    // Complete Principal's message — EXACT wording, only divided into readable sections.
    'sections' => [
        [
            'icon' => 'fa-comment-dots',
            'heading' => 'Dear Students & Parents',
            'body' =>
                '<p>Dear Students and Parents,</p>'
                . '<blockquote class="desk-pullquote"><p>“Develop a passion for learning. If you do, you will never cease to grow”.</p><cite>Anthony J. D\'Angelo.</cite></blockquote>'
                . '<p>Channawar’s e Vidyamandir is a proud mission driven school providing class education, celebrating the fact that each student is different, as a person and as a learner. We believe that powerful learning and teaching occurs under a shared spirit of respect which creates a passionate schooling experience recognized for its warmth, energy and excellence. Here people are valued and can fulfill their potential both as teachers and learners. We offer a balanced course nurturing the child to develop as a whole individual.</p>',
        ],
        [
            'icon' => 'fa-lightbulb',
            'heading' => 'Our Educational Philosophy',
            'body' =>
                '<blockquote class="desk-pullquote"><p>“Education awakens the power and beauty that lie within us.”</p></blockquote>'
                . '<p>Education does not only mean academic excellence. It rather is a harmonious and synchronized combination of hand (skills like various arts), head (Intellectual Power) and heart (Value System). In the present era of digitalized world, it the biggest challenge before educators and parents, to nurture the young minds with the indelible impressions of a holistic education.</p>',
        ],
        [
            'icon' => 'fa-puzzle-piece',
            'heading' => 'Holistic Learning',
            'body' =>
                '<p>Therefore, we come up with a vision to foster different facets of a student in order to see him/her developing as a vibrant student, responsible citizen and above all a generous and sentient human being. Our pedagogy is child centric, with emphasis on over-all growth and development of our students.</p>',
        ],
        [
            'icon' => 'fa-handshake',
            'heading' => 'Excellence Through Partnership',
            'body' =>
                '<p>We foster a positive spirit and believe in partnership between students, parents, teachers and support staff striving to create a milieu that sustains excellence. Our distinction lies in the pursuit of high academic attainment through support, encouragement, praise and motivation.</p>',
        ],
        [
            'icon' => 'fa-earth-asia',
            'heading' => 'Preparing Global Citizens',
            'body' =>
                '<blockquote class="desk-pullquote"><p>"I cannot teach anybody anything, I can only make them think."</p><cite>— Socrates</cite></blockquote>'
                . '<p>Open mindedness, a multicultural orientation, independence, a global outlook, multiple intelligences and abilities – these are the premium qualities needed today. As a 21st century organization, the school desires to set an approach to learning that incorporates inquiry, research, analytical thinking and an ethical approach that becomes a lifetime habit. The students are helped to focus on confidence building, while nurturing a strong sense of social and environmental responsibility through academic and co-curricular activities as we believe, like Paul “Bear” Bryant that,</p>'
                . '<blockquote class="desk-pullquote"><p>“It is not the will to win, but the will to prepare to win that makes the difference”.</p></blockquote>'
                . '<p>I strongly believe that education is a collaborative effort that involves professional administrators, committed teachers and motivated students. We dedicate ourselves as professional administrators in creating a dynamic education programme empowering the students in a global perspective.</p>',
        ],
        [
            'icon' => 'fa-building-columns',
            'heading' => 'World-Class Facilities',
            'body' =>
                '<p>The school is well equipped with surplus facilities like spacious classrooms, Science and Computer laboratories, Music and Dance Room, Art and Craft Room, Kindergarten Play Station, Smart Classes with Interactive Boards, Well Stocked Library, Dynamic School Website and Automatic SMS System, Safe Transport System with GPS in all vehicles, CCTV Surveillance.</p>',
        ],
        [
            'icon' => 'fa-flag-checkered',
            'heading' => 'Closing Message',
            'body' =>
                '<p>We are a group of diverse experiences and outlooks, committed to excellence in preparing learners for enriched opportunities worldwide. In short, learning at CeVM is a wholesome package of attitude, challenge and opportunity. Notwithstanding the challenges to develop altruistic human beings with raised standards of intellect, let us become equal stakeholders in moulding our children into desirable individuals.</p>'
                . '<p>Your valuable suggestions are always welcome.</p>',
        ],
    ],
    'defaults' => [
        'name' => 'Ms. Apurva Pande', 'role' => 'Principal',
        'heading' => 'A Message From Our Principal',
        'quote' => 'Develop a passion for learning. If you do, you will never cease to grow.',
        'photo' => placeholder('portrait'),
    ],
]);
