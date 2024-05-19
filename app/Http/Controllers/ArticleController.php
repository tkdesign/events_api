<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

/*
{
  "articles": [
    {
      "article_id": 1,
      "menu_item_name": "about",
      "title": "About the event",
      "short_desc": "<p>This is a conference for web developers. We will have a lot of interesting speakers and workshops. You can learn a lot of new things and meet new people. We will have a lot of fun and you will not regret coming to our event.</p>",
      "desc": "<p>This is a conference for web developers. We will have a lot of interesting speakers and workshops. You can learn a lot of new things and meet new people. We will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Speakers</h4><p>Our speakers are the best in the industry. They will share their knowledge and experience with you. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p><h4 class='text-h4'>Workshops</h4><p>We will have a lot of interesting workshops. You can learn new things and improve your skills. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Networking</h4><p>You will have the opportunity to meet new people and make new friends. You can share your knowledge and experience with others. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Location</h4><p>The event will take place in the city center. The venue is easy to reach by public transport. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Tickets</h4><p>You can buy tickets online or at the venue. The price is affordable and you will get a lot of value for your money. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Sponsors</h4><p>We have a lot of sponsors who support our event. They will provide you with food and drinks. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Contact</h4><p>If you have any questions, please contact us. We will be happy to help you. You will have a lot of fun and you will not regret coming to our event.</p>"
    },
    {
      "article_id": 2,
      "menu_item_name": "speakers",
      "title": "Speakers",
      "short_desc": "<p>Our speakers are the best in the industry. They will share their knowledge and experience with you. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p>",
      "desc": "<p>Our speakers are the best in the industry. They will share their knowledge and experience with you. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p><h4 class='text-h4'>Speaker 1</h4><p>Speaker 1 is a web developer with 10 years of experience. He will talk about the latest trends in web development. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p><h4 class='text-h4'>Speaker 2</h4><p>Speaker 2 is a web designer with 5 years of experience. She will talk about the importance of good design. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p><h4 class='text-h4'>Speaker 3</h4><p>Speaker 3 is a front-end developer with 3 years of experience. He will talk about the best practices in front-end development. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p>"
    },
    {
      "article_id": 3,
      "menu_item_name": "workshops",
      "title": "Workshops",
      "short_desc": "<p>We will have a lot of interesting workshops. You can learn new things and improve your skills. You will have a lot of fun and meet new people. You will not regret coming to our event.</p>",
      "desc": "<p>We will have a lot of interesting workshops. You can learn new things and improve your skills. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 1</h4><p>Workshop 1 is about web design. You will learn how to create beautiful and user-friendly websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 2</h4><p>Workshop 2 is about front-end development. You will learn how to create interactive and responsive websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 3</h4><p>Workshop 3 is about back-end development. You will learn how to create secure and scalable websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 4</h4><p>Workshop 4 is about mobile development. You will learn how to create mobile-friendly websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p>"
    },
    {
      "article_id": 4,
      "menu_item_name": "terms",
      "title": "Terms and conditions",
      "short_desc": "<p>These are the terms and conditions for our event. Please read them carefully before buying a ticket. You will have a lot of fun and you will not regret coming to our event.</p>",
      "desc": "<p><h2>1. Acceptance of Terms</h2>\n    <p>By accessing or using this website, you agree to be bound by these Terms and Conditions, our Privacy Policy, and all applicable laws and regulations.</p>\n    \n    <h2>2. Registration</h2>\n    <p>In order to attend conferences listed on this website, you may be required to register and provide certain information. You agree to provide accurate, current, and complete information during the registration process.</p>\n    \n    <h2>3. Payment and Refund Policy</h2>\n    <p>All payments made for conference registrations are non-refundable unless otherwise specified. Refunds, if applicable, will be processed according to our refund policy.</p>\n    \n    <h2>4. Intellectual Property</h2>\n    <p>All content provided on this website, including but not limited to text, graphics, logos, images, audio clips, and video clips, is the property of the conference organizers and is protected by copyright laws.</p>\n    \n    <h2>5. Code of Conduct</h2>\n    <p>All participants are expected to conduct themselves in a professional and respectful manner during conferences and related events. Any form of harassment, discrimination, or disruptive behavior will not be tolerated and may result in expulsion from the event.</p>\n    \n    <h2>6. Limitation of Liability</h2>\n    <p>We shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, arising from your use of this website or attendance at any conference listed herein.</p>\n    \n    <h2>7. Governing Law</h2>\n    <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of the United States of America.</p>\n    \n    <h2>8. Changes to Terms</h2>\n    <p>We reserve the right to modify or replace these Terms and Conditions at any time without prior notice. It is your responsibility to review this page periodically for changes.</p>\n    \n    <h2>9. Contact Us</h2>\n    <p>If you have any questions or concerns about these Terms and Conditions, please contact us at <a href=\"mailto:info@conferencewebsite.com\">info@conferencewebsite.com</a>.</p></p>"
    },
    {
      "article_id": 5,
      "menu_item_name": "privacy",
      "title": "Privacy policy",
      "short_desc": "<p>This is the privacy policy for our event. Please read it carefully before buying a ticket. You will have a lot of fun and you will not regret coming to our event.</p>",
      "desc": "<p></p><h2>1. Information We Collect</h2>\n    <p>We collect personal information from you when you register for a conference, purchase a ticket, or subscribe to our newsletter. This information may include your name, email address, phone number, and payment details.</p>\n    \n    <h2>2. How We Use Your Information</h2>\n    <p>We use the information we collect from you to process your registration, purchase, or subscription, and to communicate with you about upcoming conferences and events. We may also use your information to improve our website and services.</p>\n    \n    <h2>3. How We Protect Your Information</h2>\n    <p>We take appropriate security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. We use encryption to safeguard your payment details and other sensitive information.</p>\n    \n    <h2>4. Sharing Your Information</h2>\n    <p>We do not sell, trade, or rent your personal information to third parties. We may share your information with service providers who help us process payments, send emails, or manage our website. These service providers are required to protect your information and use it only for the purposes we specify.</p>\n    \n    <h2>5. Cookies</h2>\n    <p>We use cookies to collect information about your browsing behavior and preferences. Cookies are small text files that are stored on your device when you visit our website. You can disable cookies in your browser settings, but this may affect your experience on our website.</p>\n    \n    <h2>6. Changes to Privacy Policy</h2>\n    <p>We reserve the right to modify or replace this Privacy Policy at any time without prior notice. It is your responsibility to review this page periodically for changes.</p>\n    \n    <h2>7. Contact Us</h2>\n    <p>If you have any questions or concerns about this Privacy Policy, please contact us at <a href=\"mailto:events@localhost\">events@localhost</a>.</p>"
    }
  ]
}
*/

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`articles` (
  `article_id` INT NOT NULL AUTO_INCREMENT,
  `menu_item_id` INT NULL,
  `title` VARCHAR(255) NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`article_id`),
  INDEX `fk_articles_menu_item_id_idx` (`menu_item_id` ASC) VISIBLE,
  INDEX `articles_menu_created_at_idx` (`created_at` ASC) VISIBLE,
  CONSTRAINT `fk_articles_menu_item_id`
    FOREIGN KEY (`menu_item_id`)
    REFERENCES `events_backend_db`.`menu_items` (`menu_item_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `events_backend_db`.`menu_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`menu_items` (
  `menu_item_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `title` VARCHAR(45) NOT NULL,
  `page_title` VARCHAR(255) NULL,
  `path` VARCHAR(255) NOT NULL,
  `component` VARCHAR(45) NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `role` INT NULL DEFAULT 1,
  `is_article` TINYINT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  `is_top_menu_item` TINYINT NULL DEFAULT 1,
  `is_bottom_menu_item` TINYINT NULL DEFAULT 1,
  PRIMARY KEY (`menu_item_id`),
  INDEX `menu_items_role_position_idx` (`role` ASC, `position` ASC) VISIBLE,
  INDEX `menu_items_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class ArticleController extends Controller
{
    //
    public function getArticleByMenuItemName(string $name): \Illuminate\Http\JsonResponse
    {
        $article = Article::query()
            ->select(["articles.article_id", "menu_items.name as name", "articles.title", "articles.short_desc", "articles.desc"])
            ->join('menu_items', 'articles.menu_item_id', '=', 'menu_items.menu_item_id')
            ->where('menu_items.name', '=', $name)
            ->first();
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        return response()->json($article);
    }
}
