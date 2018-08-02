# 🏬 MAMP based Mining-Rigs Web-store: Mining Rig Assembly

## Description

Mining Rig Assembly is a web application that allows the users to browse different parts of a mining rig, store rig setups, and estimate the performance of their setups on one integrated site. Users can set their expected payback periods for the setups, and our application will calculate the potential profits of them based on real-time price information, and notify the user when their expected payback periods can be achieved. 

**Webiste:** [Mining-Rig-Assembly](http://rigassembly.web.engr.illinois.edu/index.php)

## Usefulness

The bitcoin market is growing at an incredible speed because of the bitcoin price surges last year. As a result, many computer components such as GPUs are also experiencing dramatic price changes. Our application aims to help users decide the right time to invest in mining rigs, without having to monitor a large amount of price information at all time. 

Although there are some mining rig profitability calculator websites, but there are several creative features distinguishing us from them:

1. Users can set their expected cost  and expected profit.
2. This website calculates the lowest cost of mining rig by comparing prices from different websites.
3. This website can notify the users when the expected profit is met.
 
## Realness
 
The data we will be using includes price information of computer parts such as `GPU`, `CPU`, `motherboard`, `power supply`, etc. We plan to collect these data from online hardware retailers such as `Newegg` and `Amazon`. We will also need to collect the price information of bitcoins, and we plan to collect it from `Google`. 

## Description of function:

### Basic Functions:

* convert user inputs into high level database queries to alter its data
* crawl real data from computer hardware website and store data into database
* update price and sales of computer hardware

### Advanced Functions
> 2 creative functions never seen in other websites/app
	
- **calculate payback period of the mining rig investment**
		
> This function is the core of this application. It allows the users to plan their investments without having to monitor every little aspect of the market at all time. It is especially useful, and convenient to have in the current situation because of how rapidly the prices are changing. 

- **comparisons between different parts/setups with visualization**

> This can help user easier to understand the tradeoff of different setups and choose the best setup based on comparison.

## Team member

<center>

|       Name       |                     Github homepage                    |
|:----------------:|:------------------------------------------------------:|
|    Jiajun Chen   |          [jiajunc](https://github.com/jiajunc)         |
|      Ryan Au     |          [asdryau](https://github.com/asdryau)         |
| Xiao Tang (Sean) | [xtang27](https://github.com/xtang27?tab=repositories) |
|     Zhenye Na    |        [Zhenye-Na](https://github.com/Zhenye-Na)       |

</center>


Group Information: [Mining-Rig-Assembly-Group-Info](https://wiki.illinois.edu/wiki/display/cs411sp18/Lifeinvader)

Project Introduction: [mining-rig-assembly](https://mining-rig-assembly.github.io/)
