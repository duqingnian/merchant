<?php
namespace App\MessageHandler;

use App\Message\MerchantMsg;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsMessageHandler]
class MerchantMsgHandler implements MessageHandlerInterface
{
	private $bot_token = '6417083688:AAEbn-Kbeb2VfDErs_QwIuMsUJ8hf6-J4Dw';
	public EntityManagerInterface $entityManager;
	
	public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
	
    public function __invoke(MerchantMsg $message)
    {
		$content = $message->getContent();
		$data = json_decode($content, true);
		echo 'MSG ACTION:'.$data['action'];
		if('MULTI_PAYOUT_CREATED' == $data['action']) //批量代付
		{
			$this->__MULTI_PAYOUT_CREATED($content);
		}
		else if('TIXIAN' == $data['action']) //提现
		{
			$merchant_id = $data['merchant_id'];
			$amount = $data['amount'];
			$wallet = $data['wallet'];
			$note = $data['note'];
			$ip = $data['ip'];
			
			$merchant = $this->entityManager->getRepository(\App\Entity\Merchant::class)->find($merchant_id);
			if($merchant)
			{
				if($amount <= $merchant->getAmount())
				{
					//资金充裕
					$model = new \App\Entity\Tixian();
					$model->setMid($merchant_id);
					$model->setAmount($amount);
					$model->setWallet($wallet);
					$model->setCreatedIp($ip);
					$model->setStatus('GENERATED');
					$model->setCreatedNote($note);
					$model->setCreatedAt(time());
					$model->setExecAt(0);
					$model->setExecNote('');
					$model->setExecIp('');
					$model->setBlanceSnapshot($merchant->getAmount());
					$model->setExecBlanceSnapshot('');
					$model->setExecUid(0);
					
					$this->entityManager->persist($model);
					$this->entityManager->flush();
					
					$balance = $merchant->getAmount() - $amount;
					//扣除商户的余额 增加提现中的金额
					$merchant->setAmount($balance);
					$txing_amount = $merchant->getTxingAmount();
					$merchant->setTxingAmount($txing_amount + $amount);
					$this->entityManager->flush();
					
					//写资金变动日志
					$tx_log = new \App\Entity\Log();
					$tx_log->setBundle('SUB_BALANCE');
					$tx_log->setCreatedAt(time());
					$tx_log->setOrderid(0);
					$tx_log->setPno($model->getId());
					$tx_log->setUid($merchant->getUid());
					$tx_log->setCid(0);
					$tx_log->setMid($merchant->getId());
					$tx_log->setIp($ip);
					$tx_log->setSummary('发起提现');
					$tx_log->setIsTest(0);
					$tx_log->setMoneyBefore($model->getBlanceSnapshot());
					$tx_log->setMoney($amount);
					$tx_log->setMoneyAfter($balance);
					$tx_log->setData(json_encode(['wallet'=>$wallet]));
					$this->entityManager->persist($tx_log);
					$this->entityManager->flush();
					
					//给商户的运维群发消息，提示该商户发起了提现
					$yw_telegram_group_id = $merchant->getYwTelegramGroupId();
					
					if('' != $yw_telegram_group_id)
					{
						$text = '['.$merchant->getName().']发起了提现:'.$amount."\n";
						$text .= "提现金额: ".$amount."\n";
						$text .= "商户余额: ".$model->getBlanceSnapshot()."\n";
						$text .= "发起时间: ".date('Y-m-d H:i:s', time())."\n";
						$text .= "提现IP: ".$ip."\n";
						$text .= "钱包地址: ".$wallet."\n";
						$text .= "备注: ".$note."\n";
						$text .= "提现编号: ".$model->getId();
						
						$this->_send_md(urlencode($text), $yw_telegram_group_id);
					}
				}
				else
				{
					//资金不足 也要创建订单
					$model = new \App\Entity\Tixian();
					$model->setMid($merchant_id);
					$model->setAmount($amount);
					$model->setWallet($wallet);
					$model->setCreatedIp($ip);
					$model->setStatus('ERROR');
					$model->setCreatedNote($note);
					$model->setCreatedAt(time());
					$model->setExecAt(time());
					$model->setExecNote('余额不足');
					$model->setExecIp('0.0.0.0');
					$model->setBlanceSnapshot($merchant->getAmount());
					$model->setExecBlanceSnapshot($merchant->getAmount());
					$model->setExecUid(-1);
					
					$this->entityManager->persist($model);
					$this->entityManager->flush();
				}
			}
			else
			{
				//商户不存在,do nothing
			}
		}
		else
		{
			//do nothing
		}
    }
	
	private function __MULTI_PAYOUT_CREATED($content)
	{
		$util_payout = new \App\Utils\UtilPayout();
		echo $util_payout->dispatch($this->entityManager,$content);
	}
	
	//发送Markdown
	private function _send_md($text,$chat_id='')
	{
		if('' != $chat_id)
		{
			$api_url = 'https://api.telegram.org/bot'.$this->bot_token.'/sendMessage?parse_mode=Markdown&text='.$text.'&chat_id='.$chat_id;
			
			$this->send_request($api_url);
		}
	}
	
	private function send_request($url, $data = null) 
	{
        $curl = curl_init ();
        curl_setopt ( $curl, CURLOPT_URL, $url );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
        if (! empty ( $data )) 
		{
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3500);
			curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3500);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt ( $curl, CURLOPT_POST, 1 );
			if(array_key_exists('http_build_query',$ext) && 1 == $ext['http_build_query'])
			{
				curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query($data) );
			}
			else
			{
				curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
			}
        }
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return array($httpCode, $response);
    }
}

