<?php

namespace Database\Seeders;

use App\Models\Lecture;
use App\Models\LectureHasSpeaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lectures = [
            [
                "title" => "Artificial Intelligence: Shaping the Future",
                "short_desc" => "Exploring the transformative impact of AI across various industries.",
                "desc" => "Dive into the world of artificial intelligence and its revolutionary potential. This lecture will explore how AI technologies like machine learning, natural language processing, and computer vision are reshaping industries such as healthcare, finance, and manufacturing. Attendees will gain insights into the latest AI advancements, real-world applications, and ethical considerations surrounding the deployment of AI systems.",
                "image" => "https://picsum.photos/300/200?image=60",
                "capacity" => 100,
                "speaker_id" => 1
            ],
            [
                "title" => "Cybersecurity in the Digital Age",
                "short_desc" => "Strategies and technologies to protect against digital threats.",
                "desc" => "This session focuses on the critical importance of cybersecurity in today’s digital landscape. Learn about the latest threats, including ransomware, phishing, and advanced persistent threats, as well as the strategies and technologies used to combat them. Experts will discuss best practices for securing data, systems, and networks, and how organizations can build a robust cybersecurity framework to protect against evolving cyber risks.",
                "image" => "https://picsum.photos/300/200?image=59",
                "capacity" => 300,
                "speaker_id" => 2
            ],
            [
                "title" => "Blockchain and Cryptocurrencies: Revolutionizing Finance",
                "short_desc" => "Understanding the impact of blockchain and cryptocurrencies on the financial sector.",
                "desc" => "Explore how blockchain technology and cryptocurrencies are revolutionizing the financial industry. This lecture will cover the fundamentals of blockchain, the rise of digital currencies like Bitcoin and Ethereum, and their implications for traditional banking and financial services. Attendees will learn about decentralized finance (DeFi), smart contracts, and the regulatory challenges facing the adoption of blockchain technologies in mainstream finance.",
                "image" => "https://picsum.photos/300/200?image=58",
                "capacity" => 200,
                "speaker_id" => 2
            ],
            [
                "title" => "Mobile Applications: The Next Generation",
                "short_desc" => "Pushing the boundaries of gaming with new technologies.",
                "desc" => "Delve into the future of game development, focusing on how advancements in AI, VR, and cloud gaming are transforming the industry. Learn from industry leaders about the latest tools, techniques, and platforms that are pushing the boundaries of what games can be, making them more immersive and engaging than ever before. This session will cover the entire game development lifecycle, from initial concept to final release, and the future trends shaping the gaming landscape.",
                "image" => "https://picsum.photos/300/200?image=55",
                "capacity" => 100,
                "speaker_id" => 4,
            ],
            [
                "title" => "Game Development: From Concept to Creation",
                "short_desc" => "Pushing the boundaries of gaming with new technologies.",
                "desc" => "Delve into the future of game development where VR, AR, and AI are reshaping the gaming landscape. Industry experts will discuss the latest tools and methodologies that are enabling developers to create more immersive, interactive, and dynamic gaming experiences, setting new standards in entertainment.",
                "image" => "https://picsum.photos/300/200?image=56",
                "capacity" => 300,
                "speaker_id" => 5,
            ],
            [
                "title" => "Microservices Architecture: Building Scalable Systems",
                "short_desc" => "Designing and deploying scalable and resilient systems with microservices.",
                "desc" => "This lecture focuses on the principles and practices of microservices architecture, a modern approach to designing scalable and resilient software systems. Attendees will learn about the benefits of microservices, including improved scalability, flexibility, and fault tolerance, as well as the challenges of implementing and managing microservices in a production environment. Topics covered will include service decomposition, API design, containerization, orchestration with Kubernetes, and best practices for ensuring security and monitoring in a microservices-based system.",
                "image" => "https://picsum.photos/300/200?image=57",
                "capacity" => 200,
                "speaker_id" => 6,
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Lecture::truncate();

        foreach ($lectures as $lecture) {
            $speaker_id = $lecture['speaker_id'];
            unset($lecture['speaker_id']);
            Lecture::create($lecture);
            LectureHasSpeaker::create([
                'lecture_id' => Lecture::latest()->first()->lecture_id,
                'speaker_id' => $speaker_id
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
