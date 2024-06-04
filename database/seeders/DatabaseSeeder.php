<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Race;
use App\Models\RequiredTalent;
use App\Models\Requirement;
use App\Models\Rule;
use App\Models\Talent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends
    Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        function Role($name) {
            $Model = new \App\Models\Role();
            $Model->name = $name;
            $Model->save();
        }

        Role("user");
        Role("moderator");
        Role("admin");

        function AdminUser($username, $email, $password): void {
            $Model = new \App\Models\User();
            $Model->username = $username;
            $Model->email = $email;
            $Model->email_verified_at = now();
            $Model->remember_token = Str::random(10);
            $Model->role_id = 3;
            $Model->password = Hash::make($password);
            $Model->save();
            error_log(
                $Model->createToken(
                    'authToken',
                    [
                        'change password',
                        'change email',
                        'password reset',
                        'create',
                        'read',
                        'update',
                        'destroy'
                    ]
                )->plainTextToken
            );
        }

        AdminUser("admin", "admin@gmail.com", 'password');

        function User($username, $email, $password): void {
            $Model = new \App\Models\User();
            $Model->username = $username;
            $Model->email = $email;
            $Model->email_verified_at = now();
            $Model->remember_token = Str::random(10);
            $Model->role_id = 1;
            $Model->password = Hash::make($password);
            $Model->save();
        }

        User("test", "test@gmail.com", 'password');

        function Genre($id, $name, $description): void {
            $Model = new \App\Models\Genre();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->save();
        }

        Genre(1, "Fantasy", "Generic fantasy ttrpg with dragons, orcs and loot galore.");
        Genre(2, "Sci-Fi", "Generic sci-fi ttrpg with spaceships, xenos and tech galore");
        Genre(3, "Superhero", "Generic superhero ttrpg with sidekicks, villains and banter galore");

        function Book($id, $name, $description, $genre_id, $publication_date) {
            $Model = new \App\Models\Book();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->genre_id = $genre_id;
            $Model->publication_date = $publication_date;
            $Model->save();
        }

        /* Fantasy */
        Book(1, "Core Rulebook", "The core rulebook for a generic fantasy system", 1, "2023/11/10");
        Book(2, "The Draconic Expansion", "A book for a generic fantasy system filled with draconic options", 1, "2023/11/10");
        Book(3, "The Infernal Realms", "A book for a generic fantasy system filled with fiendish options and devil deals", 1, "2023/11/10");
        Book(4, "The Empyrean Realms", "A book for a generic fantasy system filled with angelic options and divine boons", 1, "2023/11/10");
        Book(5, "The Shadows of Death", "A book for a generic fantasy system filled with undead minions and necrotic spells", 1, "2023/11/10");
        /* Sci-fi */
        Book(6, "Core Rulebook", "The core rulebook for a generic sci-fi system", 2, "2023/11/10");
        /* Superhero */
        Book(7, "Core Rulebook", "The core rulebook for a generic superhero system", 3, "2023/11/10");

        function Talent($id, $name, $experience_cost, $description, $flavor, $system, $book_id) {
            $Model = new \App\Models\Talent();
            $Model->id = $id;
            $Model->name = $name;
            $Model->experience_cost = $experience_cost;
            $Model->description = $description;
            $Model->flavor = $flavor;
            $Model->system = $system;
            $Model->book_id = $book_id;
            $Model->save();
        }

        /* Fantasy */
        Talent(1, "Armor Training", 1, "You gain training in light armor", "You can easily move around in armor and equip it.", "You become trained with light armor.", 1);
        Talent(2, "Weapon Training", 1, "You gain training in simple weapons", "You know how to handle a weapon without hitting yourself.", "You become trained with simple weapons.", 1);
        Talent(3, "Rallying Charge", 1, "You rally your allies and charge forward", "With you at the helm, the only thing your allies have to fear is getting in the way.", "You spend 3 actions to make a call to arms. You and all allies who can hear you can move up to their speed and make a single attack.", 1);
        Talent(4, "Dragon's Blood", 1, "You have the blood of a dragon coursing through you.", "flavor", "system", 2);
        Talent(5, "Dragon's Breath", 1, "You breathe the elements like the dragons of old", "flavor", "system", 2);
        Talent(6, "Draconic Scales", 1, "Scales that protect from both the elements and physical blows", "flavor", "system", 2);
        Talent(7, "Devil Contract", 0, "You make a contract with a Devil for fiendish powers.", "flavor", "system", 3);
        Talent(8, "Divine Boon", 0, "Your actions have not gone unnoticed, and the heaven's above grant you their blessing.", "flavor", "system", 4);
        Talent(9, "Animate Dead", 1, "You reanimate the dead to do your bidding", "flavor", "Spend XP up to half the targets XP. The creature reanimates as undead with only the given amount of XP available for the talents it had in life. When the minion dies, you regain the amount of XP spent, this XP can only be used on Animate Dead. Pay additional XP depending on size.", 5);
        Talent(10, "Mass Animate Dead", 3, "Reanimate an army at the snap of your fingers", "flavor", "As Animate Dead, but any number of targets", 5);
        Talent(11, "Undead Militia", 5, "Your undead are stronger and more versatile", "flavor", "All undead created by you, using animate dead, gain Armor Training (All) and Weapon Training (All)", 5);
        Talent(12, "Condescending Teamwork", 5, "Your belief that you're better than everyone else allows you to pull others to your level.", "flavor", "Your allies count as minions for talents with the minion trait.", 1);
        Talent(13, "Dwarven Stoutness", 2, "You're as heavy and tough as a chunk of metal, and as agile.", "flavor", "You count as 2 sizes larger for the purposes of weight and size modifiers (flight, stealth, attack, defense, damage and damage reduction).", 1);
        Talent(17, "Magic Blood", 1, "Your magic comes from the blood flowing through you", "Your magic comes as naturally to you as breathing. A simple wave of the hand and you can call waves of water to capsize ships.", "You gain a number of Source Points equal to your constitution. Temporary changes to your Constitution does not increase or decrease the amount of Source Points gained from this talent. <br><br> Additionally you gain the Natural Talent Action <br><br> <strong>Natural Talent</strong> <br> As a free action you can spend a source point to reduce the number of action needed to cast your next spell by one. This can only reduce the number of actions needed to a minimum of zero.", 1);
        Talent(18, "Rune Caster", 1, "Your magic comes from ancient runes, bending and twisting the magic to do your bidding.", "You trace intricate and ancient runes in the air, forcing the magic found in everything to bend to your will. A single rune can hold thousand of different meanings allowing you to force the magic to do many different things.", "You can use talents with the spell trait, without expending Source Points. When a talent is used in this way, the talent counts as having used a number of Source Points up to your Intelligence. Additionally a talent used this way gains the Somatic trait and takes an additional action to use.", 1);
        Talent(19, "Rune Book", 1, "You've learnt to write and memorize a plethora of spells", "Ancient runes fill the pages of this dusty tome.","When you buy this talent you must choose a book you own, that book is considered your Rune Book, if the Rune Book is ever lost or destroyed you can choose a new book that you own. <br><br> You can buy talents with the spell trait, for 1 XP less, to a minimum of 0 XP. Talents bought this way are written into your Rune Book. If the Rune Book is ever destroyed you lose all the talents written in the book, but regain the XP expended, this XP can only be used to buy talents using this talent. <br><br> Each morning you must choose a number of spells written in your Rune Book. You can choose a number of spells up to your Intelligence. For that day you can use the chosen spells. <br><br> You gain the Revise Action (TODO: make actions their own thing) <br><br> <strong>Revise</strong><br>You can use 3 actions to change 1 spell chosen for another spell in your Rune Book.", 1);
        Talent(20, "Pyromancy", 1, "You've learnt to control fire", "flavor", "Your mastery over fire grants you the following actions: <br><br> <strong>Firebolt (1 action, Somatic trait, Spell trait)</strong> <br> You hurl a small ball of fire at an opponent, dealing 1d6 damage for each Source Point Spent <br><br> <strong>Fireball (3 action, Somatic trait, Spell trait)</strong> <br> You hurl a giant aoe fireball at your enemies, dealing 1d6 damage for each Source Point Spent", 1);
        /* Sci-fi */
        Talent(14, "Xenophobic", -1, "You're xenophobic", "flavor", "system", 6);
        /* Superhero */
        Talent(15, "Let Loose", 10, "You're always holding back", "Spellcasters come in wide varieties, casting spells from dusty old tomes, or borrowing power from something greater.", "Double your physical stats in dire situations", 7);

        /* Sync talents with required talent relations */
        Talent::find(5)->required_talents()->sync([4]);
        Talent::find(6)->required_talents()->sync([4]);
        Talent::find(10)->required_talents()->sync([9]);
        Talent::find(11)->required_talents()->sync([10]);
        Talent::find(19)->required_talents()->sync([18]);


        function Requirement($id, $name, $description, $system) {
            $Model = new \App\Models\Requirement();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }

        Requirement(1, "Source", "A talent with this requirement requires a talent with the source trait.", "system");

        /* Sync talents with requirements relations */
        Talent::find(3)->talent_requirements()->sync([1]);
        Talent::find(20)->talent_requirements()->sync([1]);

        function Category($id, $name, $description, $system) {
            $Model = new \App\Models\Category();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }

        Category(1, "Combat", "A talent that deals or reduces damage.", "system");
        Category(2, "Movement", "A talent that includes movement or that moves another target", "system");
        Category(3, "Augment", "A talent that alters another talent, either buffing, debuffing or changing how it works", "system");
        Category(4, "Utility", "A talent that typically is non-combat, which interacts with environment, or offers other solutions to problems", "system");
        Category(5, "Social", "A talent that increases ones sociability, connections, or standing in a faction", "system");
        Category(6, "Flaw", "A talent that is a detriment to a character, but grants other advantages", "system");
        Category(7, "Teamwork", "A talent that only works together with allies that share the same talent", "system");

        /* Sync talents with category relations */
        Talent::find(1)->talent_categories()->sync([1]);
        Talent::find(2)->talent_categories()->sync([1]);
        Talent::find(3)->talent_categories()->sync([1, 2]);
        Talent::find(4)->talent_categories()->sync([1]);
        Talent::find(5)->talent_categories()->sync([1]);
        Talent::find(6)->talent_categories()->sync([1]);
        Talent::find(7)->talent_categories()->sync([4]);
        Talent::find(8)->talent_categories()->sync([4]);
        Talent::find(9)->talent_categories()->sync([4]);
        Talent::find(10)->talent_categories()->sync([3, 4]);
        Talent::find(11)->talent_categories()->sync([3, 4]);
        Talent::find(12)->talent_categories()->sync([3, 5]);
        Talent::find(13)->talent_categories()->sync([3]);
        Talent::find(14)->talent_categories()->sync([6]);
        Talent::find(15)->talent_categories()->sync([1]);
        Talent::find(17)->talent_categories()->sync([3, 4]);
        Talent::find(18)->talent_categories()->sync([3, 4]);
        Talent::find(19)->talent_categories()->sync([3, 4]);
        Talent::find(20)->talent_categories()->sync([1]);

        function TraitModel($id, $name, $description, $system) {
            $Model = new \App\Models\TraitModel();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }

        TraitModel(1, "Magic", "A talent that involves the use of magic.", "Talents with the magic trait don't work in no magic zones.");
        TraitModel(2, "Diverse", "A talent with a wide array of options to choose from.", "Talents with the Diverse trait can be taken any number of times, but any option chosen from the talent can only be chosen once.");
        TraitModel(3, "Heritage", "A talent that gives you power through your bloodline. ", "Talents with the Heritage trait affect your race in one way or another.");
        TraitModel(4, "Minion", "A talent that grants control over a minion, such as a pet or undead, or involves a minion.", "Talents with the minion trait only work on minions or create minions.");
        TraitModel(5, "Verbal", "A talent that uses sound to muster allies or to demoralize enemies.", "Talents with the verbal trait need to be used with speech, instruments or similar.");
        TraitModel(6, "Source", "A talent that grants the wielder a source of magic to use for other talents", "Talents with the source trait also gain the magic trait. Additionally a talent can only expend Source Points from a single source talent and can never expend less than zero source points.");
        TraitModel(7, "Spell", "A talent that uses a source of magic for its effects", "Talents with the spell trait also gain the magic trait. A Spell can only expend Source Points from a single source talent, and can never expend less than zero source points.");

        /* Sync talents with trait relations */
        Talent::find(4)->talent_traits()->sync([3]);
        Talent::find(5)->talent_traits()->sync([3]);
        Talent::find(6)->talent_traits()->sync([3]);
        Talent::find(7)->talent_traits()->sync([2]);
        Talent::find(8)->talent_traits()->sync([2]);
        Talent::find(9)->talent_traits()->sync([1, 4, 7]);
        Talent::find(10)->talent_traits()->sync([1, 4]);
        Talent::find(11)->talent_traits()->sync([1, 4]);
        Talent::find(12)->talent_traits()->sync([4]);
        Talent::find(13)->talent_traits()->sync([3]);
        Talent::find(17)->talent_traits()->sync([6]);
        Talent::find(18)->talent_traits()->sync([6]);
        Talent::find(20)->talent_traits()->sync([7]);

        function Rule($id, $name, $description, $flavor, $system) {
            $Model = new \App\Models\Rule();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->flavor = $flavor;
            $Model->system = $system;
            $Model->save();
        }

        Rule(1, "Damage Reduction", "A number which reduces the damage taken", "Damage reduction can be anything from force fields, armor, hulking muscles or even scales.", "Damage Reduction reduces damage taken by the given number to a minimum of 0. The reduction is applied after any division to the damage. A negative damage reduction instead increases damage taken.");
        Rule(2, "Size", "Size can determine a lot regarding a creature", "Being a hulking dragon nets some bonuses, being harder to damage due to your sheer size, but a lot easier to hit.", "A creature gains benefits and penalties regarding their size as seen on Table 1 - Size and Modifiers.");

        Rule::find(1)->book_rules()->sync([1, 6, 7]);
        Rule::find(2)->book_rules()->sync([1, 6, 7]);

        function Size($name, $description, $system, $height, $weight, $flight_modifier, $stealth_modifier, $attack_modifier, $defense_modifier, $damage_modifier, $damage_reduction_modifier) {
            $Model = new \App\Models\Size();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->height = $height;
            $Model->weight = $weight;
            $Model->flight_modifier = $flight_modifier;
            $Model->stealth_modifier = $stealth_modifier;
            $Model->attack_modifier = $attack_modifier;
            $Model->defense_modifier = $defense_modifier;
            $Model->damage_modifier = $damage_modifier;
            $Model->damage_reduction_modifier = $damage_reduction_modifier;
            $Model->save();
        }

        Size("Tiny", "description", "system", "0.3 to 0.6 metres", "0.5 to 4 kilograms", 4, 4, 4, 4, -8, -8);
        Size("Small", "description", "system", "0.6 to 1.2 metres", "4 to 32 kilograms", 2, 2, 2, 2, -4, -4);
        Size("Medium", "description", "system", "1.2 to 2.4 metres", "32 to 256 kilograms", 0, 0, 0, 0, 0, 0);
        Size("Large", "description", "system", "2.4 to 4.8 metres", "256 to 2048 kilograms", -2, -2, -2, -2, 4, 4);
        Size("Huge", "description", "system", "4.8 to 9.6 metres", "2048 to 4096 kilograms", -4, -4, -4, -4, 8, 8);

        function Sense($id, $name, $description, $flavor, $system) {
            $Model = new \App\Models\Sense();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->flavor = $flavor;
            $Model->system = $system;
            $Model->save();
        }

        Sense(1, "Low-Light Vision", "You can see perfectly in bright and dim light", "flavor", "You don't take penalties from dim light");
        Sense(2, "Night Vision", "You can see perfectly in bright light, dim light and darkness", "flavor", "You don't take penalties from dim light or darkness");
        Sense(3, "Echolocation", "you can see using sound", "flavor", "You don't take penalties from lack of light");

        function Type($id, $name, $description, $flavor, $system) {
            $Model = new \App\Models\Type();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->flavor = $flavor;
            $Model->system = $system;
            $Model->save();
        }

        Type(1, "Humanoid", "A typical humanoid", "flavor", "system");
        Type(2, "Undead", "A corpse mimicking the echoes of its former life", "flavor", "system");
        Type(3, "Elemental", "Pure element given life through unknown means", "flavor", "system");
        Type(4, "Draconic", "Ancient scaled beasts of many shapes and sizes", "flavor", "system");

        function Race($id, $name, $description, $flavor, $system, $experience_cost, $hit_points, $book_id) {
            $Model = new \App\Models\Race();
            $Model->id = $id;
            $Model->name = $name;
            $Model->description = $description;
            $Model->flavor = $flavor;
            $Model->system = $system;
            $Model->experience_cost = $experience_cost;
            $Model->hit_points = $hit_points;
            $Model->book_id = $book_id;
            $Model->save();
        }

        Race(1, "Human", "Basic, but versatile", "Considered bland as they lack any gimmick to make them stand out, however their bland nature combined with their ingenuity lets them easily fit themselves into any environment", "system", 0, 6, 1);
        Race(2, "Dwarf", "Short and stout like a beer barrel", "Looking like a beer barrel and acting like one who has drunk an entire beer barrel, the dwarven race is rough around the edges. Nonetheless their craftsmanship is unmatched and their resilience is only second to that of the mountains.", "system", 9, 10, 1);
        Race(3, "Dragonkin", "A mixture of humanoid and draconic", "Appearing to be a human mixed with a dragon, the dragonkin shares their draconic ancestors powers and greed, but lack their size and shape.", "system", 12, 12, 2);

        /* Sync races with type relations */
        Race::find(1)->race_types()->sync([1]);
        Race::find(2)->race_types()->sync([1]);
        Race::find(3)->race_types()->sync([1, 4]);

        /* Sync races with talent relations */
        Race::find(2)->race_talents()->sync([13]);
        Race::find(3)->race_talents()->sync([4, 5, 6]);

        /* Sync races with type relations */
        Race::find(1)->race_types()->sync([1]);
        Race::find(2)->race_types()->sync([1]);
        Race::find(3)->race_types()->sync([1, 4]);
    }
}
