<?php

namespace spawner;

use pocketmine\block\Block;
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\block\{BlockBreakEvent, BlockPlaceEvent};
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\tile\MobSpawner;
use pocketmine\utils\Config;

use onebone\economyapi\EconomyAPI;

/*
 *This plugin is a edit with added codes by Karanpatel567,
 *You can redistribute this and edit/modify it!
 */


class PTask extends PluginTask{
 
 /** @var Main */
 public $plugin;
 /** @var Block */
 public $block;
 /** @var string */
 public $type;
 
 public function __construct(Main $plugin, Block $block, string $type){
  parent::__construct($plugin);
  $this->plugin = $plugin;
  $this->block = $block;
  $this->type = $type;
 }
 
 /**
  * @param int $tick
  *
  * @return void
  */
 public function onRun(int $tick){
  $tile = $this->block->getLevel()->getTile(new Vector3($this->block->getX(), $this->block->getY(), $this->block->getZ()));
  if($tile instanceof MobSpawner) {
   echo "Translating to {$this->type}...";
   switch($this->type){
    case "zombie":
     $tile->setEntityId(32);
     break;
    case "pigman":
     $tile->setEntityId(36);
     break;
    case "spider":
     $tile->setEntityId(35);
     break;
    case "iron_golem":
     $tile->setEntityId(20);
     break;
    case "blaze":
     $tile->setEntityId(43);
     break;
    case "pig":
     $tile->setEntityId(12);
     break;
    case "cow":
     $tile->setEntityId(11);
     break;
    case "chicken":
     $tile->setEntityId(10);
     break;
    case "squid":
     $tile->setEntityId(17);
   }
  }
 }
 
}

class Main extends PluginBase implements Listener{
 
  public $cfg;
  public $eco;
  public function onEnable() {
    
    if(!is_dir($this->getDataFolder())) {
      mkdir($this->getDataFolder());
      }
      
    $this->cfg = new Config($this->getDataFolder() ."settings.yml", Config::YAML, [
    "zombie" => 20000,
    "skeleton" => 21000,
    "spider" => 15000,
    "pigman" => 10000,
    "iron_golem" => 15000,
    "blaze" => 10000,
    "pig" => 5000,
    "cow" => 5000,
    "chicken" => 5000,
    "squid" => 1500
    ]);
    
    $this->eco = EconomyAPI::getInstance();
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
    
    }
    
    public function onCommand(CommandSender $s, Command $cmd, $label, array $args) {
      
      if($cmd->getName() == "spawner") {
        
        if(isset($args[0])) {
          
          if(strtolower($args[0]) == "list") {
            foreach($this->cfg->getAll() as $key => $val) {
              
              $s->sendMessage("§d» §b". $key .": §e". $val);
              }
            }
            
          switch(strtolower($args[0])) {
            
            case "squid":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("squid")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("squid"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dSquid Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» §aYou have bought a§e Squid Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("squid") ."$");
                   }
                  break;
                  
            case "chicken":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("chicken")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("chicken"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dChicken Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a§e Chicken Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get('chicken") ."$");
                   }
                  break;
                  
            case "cow":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               $this->eco->reduceMoney($s->getName(), $this->cfg->get("cow"));
               
               if($pmoney >= $this->cfg->get("cow")) {
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dCow Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §e Cow Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("cow") ."$");
                   }
                  break;
                  
            case "pig":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("pig")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("pig"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dPig Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §ePig Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("pig") ."$");
                   }
                  break;
                  
            case "blaze":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("blaze")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("blaze"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dBlaze Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §eBlaze Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("blaze") ."$");
                   }
                  break;
                  
            case "iron_golem":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("iron_golem")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("iron_golem"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dIron Golem Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §eIron Golem Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("iron_golem") ."$");
                   }
                  break;
                  
            case "pigman":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("pigman")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("pigman"));
               
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dPigman Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §ePigMan Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("pigman") ."$");
                   }
                  break;
                  
            case "spider":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("spider")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("spider"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dSpider Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §eSpider Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money, Spawner Cost: §a". $this->cfg->get("spider") ."$");
                   }
                  break;
                  
               case "skeleton":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("skeleton")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("skeleton"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dSkeleton Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a  §eSkeleton Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("skeleton") ."$");
                   }
                  break;
                  
            case "zombie":
              
               $pmoney = $this->eco->myMoney($s->getName());
               
               if($pmoney >= $this->cfg->get("zombie")) {
                 
                 $this->eco->reduceMoney($s->getName(), $this->cfg->get("zombie"));
                 
                 $spawnblock = Item::get(52, 0, 1);
                 
                 $spawnblock->setCustomName("§r§dZombie Spawner");
                 
                 $s->getInventory()->addItem($spawnblock);
                 $s->sendMessage("§a» You have bought a §eZombie Spawner!");
                 } else {
                   $s->sendMessage("§c» You don't have enough money!, Spawner Cost: §a". $this->cfg->get("zombie") ."§a$");
                   }
                  break;
                }
              } else {
                $s->sendMessage("Use: /spawner <mob>");
                }
              }
            }
            
        public function onPlace(BlockPlaceEvent $ev) {
          $p = $ev->getPlayer();

          $block = $ev->getBlock();
          $item = $ev->getItem();
          
          if($block->getId() == 52) {
            
            switch($item->getName()) {
              
              case "§r§dZombie Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "zombie"), 20);
                break;
              case "§r§dSkeleton Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "skeleton"), 20);
                break;
              
              case "§r§dSpider Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "spider"), 20);
                break;
              
              case "§r§dPigman Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "pigman"), 20);
                break;
                
              case "§r§dIron Golem Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "iron_golem"), 20);
                break;
                
              case "§r§dBlaze Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "blaze"), 20);
                break;
              
              case "§r§dPig Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "pig"), 20);
                break;
              
              case "§r§dCow Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "cow"), 20);
                break;
                
              case "§r§dChicken Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "chicken"), 20);
                break;
                
              case "§r§dSquid Spawner":
              
                $this->getServer()->getScheduler()->scheduleDelayedTask(new PTask($this, $block, "squid"), 20);
                break;
               }
             }
           }
           
           public function onBreak(BlockBreakEvent $ev) {
           if (!$event->isCancelled()){
           $block = $ev->getBlock();
           $player = $ev->getPlayer();
           $tile = $player->getLevel()->getTile($block);
           if($block->getId() == 52) {
           
           if($player->getInventory()->getItemInHand()->hasEnchantment(16)) {
           
            if($tile instanceof MobSpawner) {
            
              $eid = $tile->getEntityId();
              
              switch($eid) {
              
              case "32":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dZombie Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "33":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dPigman Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "34":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dSkeleton Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "35":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dSpider Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "20":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dIron Golem Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "43":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dBlaze Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "12":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dPig Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "10":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dCow Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "11":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dChicken Spawner");
              $player->getInventory()->addItem($item);
              break;
              
              case "13":
              $item = Item::get(52, 0, 1);
              $item->setCustomName("§r§dSquid Spawner");
              $player->getInventory()->addItem($item);
              break;
              }
             }
            }
          }
        }
      }
    }
