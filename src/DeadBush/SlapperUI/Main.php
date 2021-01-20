<?php

namespace DeadBush\SlapperUI;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener {
	public function onEnable(){
		$this->getLogger()->info("§6========================================");
		$this->getLogger()->info("§ePlugin By DeadBush");
		$this->getLogger()->info("§eSubscribe To My YouTube Channel");
		$this->getLogger()->info("§ehttps://youtube.com/deadbush");
		$this->getLogger()->info("§6========================================");
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
		switch($cmd->getName()){
			case "slapperui":
			if($sender instanceof Player){
				if($sender->hasPermission("slapperui.use")){
					$this->slapperui($sender);
				}else{
					$sender->sendMessage("§4You Don't Have Permission To Use This Command");
				}
			}
		}
	return true;
	}

	public function slapperui($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->create($player);
			break;

			case 1:
			    $this->getServer()->dispatchCommand($player, "slapper id");
			break;

			case 2:
                $this->remove($player);
			break;

			case 3:
                $this->rename($player);
			break;

			case 4:
                $this->addcommand($player);
			break;

			case 5:
                $this->removecommand($player);
			break;
		}
		});
		$form->setTitle("§l§4SLAPPER UI");
		$form->addButton("§lCreate Slapper");
		$form->addButton("§lGet Id");
		$form->addButton("§lRemove Slapper");
		$form->addButton("§lRename Slapper");
		$form->addButton("§lAdd Command");
		$form->addButton("§lRemove Command");
		$form->sendToPlayer($player);
		return $form;
	}

	public function create($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "slapper spawn " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§aCREATE SLAPPER");
		$form->addInput("§eEnter The Type of Slapper You Want To Spawn");
		$form->addInput("§eEnter The Display Name Of The Slapper You Want");
		$form->sendToPlayer($player);
		return $form;
	}

	public function remove($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "slapper remove " . $data[0]);
		});
		$form->setTitle("§l§aREMOVE SLAPPER");
		$form->addInput("§eEnter The ID Of Slapper You Want To Remove");
		$form->sendToPlayer($player);
		return $form;
	}

	public function rename($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "slapper edit " . $data[0] . " name " . $data[1]);
		});
		$form->setTitle("§l§aRENAME SLAPPER");
		$form->addInput("§eEnter The ID Of Slapper You Want To Rename");
		$form->addInput("§eEnter The Name You Want To Be Changed Too");
		$form->sendToPlayer($player);
		return $form;
	}

	public function addcommand($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "slapper edit " . $data[0] . " addcommand rca {player} " . $data[1]);
		});
		$form->setTitle("§l§aADD COMMAND");
		$form->addInput("§eEnter The ID Of Slapper You Want To Add Command");
		$form->addInput("§eEnter The Command Without /");
		$form->sendToPlayer($player);
		return $form;
	}

	public function removecommand($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "slapper edit " . $data[0] . " delcommand rca {player} " . $data[1]);
		});
		$form->setTitle("§l§aREMOVE COMMAND");
		$form->addInput("§eEnter The ID Of Slapper You Want To Remove Command");
		$form->addInput("§eEnter The Command Without /");
		$form->sendToPlayer($player);
		return $form;
	}
}