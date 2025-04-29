<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->truncate();
        DB::table('reviews')->insert([
            [
                'text' => "The essay was well-organized, with a clear introduction, body, and conclusion. Your argument was strong, and I particularly liked how you backed up your points with evidence from credible sources. However, I noticed a few grammatical errors and some awkward phrasing that made certain parts difficult to read. It might help to read through your essay out loud to catch these issues. Overall, it's a solid piece of work!",
                'assessment_id' => '1',
                'reviewer_id' => '1',
                'reviewee_id' => '2',
                'review_rate' => 'null'
            ],
            [
                'text' => "Your code is very clean and well-documented, making it easy to follow. The logic behind your solution is sound, and it meets all the requirements of the assignment. One thing you could improve is the efficiency of your algorithm. It works well for small datasets, but it might struggle with larger inputs. Consider optimizing the loop in the processData function to improve performance. Great job overall!",
                'assessment_id' => '1',
                'reviewer_id' => '1',
                'reviewee_id' => '3',
                'review_rate' => 'null'
            ],
            [
                'text' => "The presentation was engaging, and it was clear that everyone in the group had a strong understanding of the topic. I appreciated how you used visuals to support your points, which made the information easier to digest. One suggestion I have is to work on transitioning between speakers more smoothly. At times, it felt a bit disjointed. Practicing the flow of the presentation might help. Otherwise, excellent work!",
                'assessment_id' => '1',
                'reviewer_id' => '2',
                'reviewee_id' => '1',
                'review_rate' => 'null'
            ],
            [
                'text' => "I really enjoyed your design project. The color scheme and layout were both visually appealing and functional. It’s clear that you have a good eye for detail. One area for improvement could be in user experience; some elements were not as intuitive as they could be. For example, the navigation could be simplified to make it easier for users to find what they’re looking for. This would enhance the overall usability of the design. Keep up the great work!",
                'assessment_id' => '1',
                'reviewer_id' => '2',
                'reviewee_id' => '3',
                'review_rate' => 'null'
            ],
            [
                'text' => "The research paper is well-researched and comprehensive. Your analysis of the data is thorough and insightful. I particularly liked how you linked your findings back to the original research question, which showed a deep understanding of the topic. On the downside, the literature review section could be expanded to include more recent studies. This would give your paper more context and strengthen your argument. Overall, this is a very impressive piece of research!",
                'assessment_id' => '1',
                'reviewer_id' => '4',
                'reviewee_id' => '5',
                'review_rate' => 'null'
            ],
            [
                'text' => "I loved the creativity and originality of your story. The characters were well-developed, and the plot kept me engaged from start to finish. Your use of imagery was particularly effective, bringing the scenes to life. However, I think the pacing could be improved in the middle section, where the story seemed to slow down a bit. Tightening up this part would help maintain the reader's interest. Fantastic job!",
                'assessment_id' => '1',
                'reviewer_id' => '4',
                'reviewee_id' => '6',
                'review_rate' => 'null'
            ],
            [
                'text' => "You did an excellent job analyzing the dataset and drawing meaningful insights. The visualizations you created were clear and effectively communicated the trends in the data. I also appreciated the way you highlighted potential outliers and discussed their impact on the analysis. One suggestion I have is to include a section on potential limitations of your analysis, such as assumptions made during data cleaning or possible biases in the dataset. This would add depth to your conclusions. Overall, it's a strong project with valuable findings.",
                'assessment_id' => '1',
                'reviewer_id' => '5',
                'reviewee_id' => '4',
                'review_rate' => 'null'
            ],
            [
                'text' => "The video presentation was very engaging and informative. You did a great job explaining complex concepts in a way that was easy to understand. The visuals were well-chosen and complemented your narration perfectly. One area for improvement could be the pacing of your speech. There were a few moments where it felt a bit rushed, making it difficult to catch all the details. Slowing down slightly, especially when introducing key points, would make the presentation even more effective. Great work on putting together such a professional video!",
                'assessment_id' => '2',
                'reviewer_id' => '1',
                'reviewee_id' => '4',
                'review_rate' => 'null'
            ],
            [
                'text' => "The lab report was thorough and well-organized. I appreciated how you clearly outlined the hypothesis, methodology, results, and conclusions. The inclusion of detailed graphs and tables made it easy to follow your findings. One area where you could improve is in the discussion section. It would be beneficial to compare your results with existing literature to provide more context and discuss any discrepancies. This would help strengthen your interpretation of the results. Overall, this is a solid report that demonstrates a good understanding of the experiment.",
                'assessment_id' => '2',
                'reviewer_id' => '1',
                'reviewee_id' => '9',
                'review_rate' => 'null'
            ],
        ]);
    }
}
