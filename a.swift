/
//  AppDelegate.swift
//  TabProgDemo
//
//  Created by Steven Lipton on 9/7/14.
//  Copyright (c) 2014 MakeAppPie.Com. All rights reserved.
//
import UIKit
 
@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {
     
    var window: UIWindow?
     
    func application(application: UIApplication, didFinishLaunchingWithOptions launchOptions: [NSObject: AnyObject]?) -&gt; Bool {
     
        let tabBarController = UITabBarController()
        let myVC1 = PieVC(nibName: "PieVC", bundle: nil)
        let myVC2 = PizzaVC(nibName: "PizzaVC", bundle: nil)
        let controllers = [myVC1,myVC2]
        tabBarController.viewControllers = controllers
        window?.rootViewController = tabBarController
        let firstImage = UIImage(named: "pie bar icon")
        let secondImage = UIImage(named: "pizza bar icon")
        myVC1.tabBarItem = UITabBarItem(title: "Pie", image: firstImage, tag: 1)
        myVC2.tabBarItem = UITabBarItem(title: "Pizza", image: secondImage, tag:2)
        return true
    }
}
 
import UIKit
class OrderModel: NSObject {
    var pizza:String? = nil
    var pie:String? = nil
 
    func currentOrder() -> String{ //return a string with the current order
        var pizzaOrder = "No"
        var pieOrder = "No"
        if (pizza != nil) {
            pizzaOrder = pizza!
        }
        if (pie != nil){
            pieOrder = pie!
        }
        return pizzaOrder + " pizza and " + pieOrder + " pie"
    }
}
//
//  ViewController.swift
//  TabProgDemo
//
//  Created by Steven Lipton on 9/7/14.
//  Copyright (c) 2014 MakeAppPie.Com. All rights reserved.
//
 
import UIKit
 
class ViewController: UIViewController {
// Doesn't do anything, just needs to be there to start creation process
 }
 
//
//  PizzaVC.swift
//  TabProgDemo
//
//  Created by Steven Lipton on 9/7/14.
//  Copyright (c) 2014 MakeAppPie.Com. All rights reserved.
//
 
import UIKit
 
class PizzaVC: UIViewController {
    var myOrder = OrderModel()
    @IBOutlet weak var orderLabel: UILabel!
    @IBAction func orderButton(sender: UIButton) {
    //connect this to as many buttons as you need to list pizzas
        myOrder.pizza = sender.titleLabel?.text
        orderLabel.text = myOrder.currentOrder()
    }
     
    override func viewWillAppear(animated: Bool) {
        super.viewWillAppear(animated)
        orderLabel.text = myOrder.currentOrder()
    }
     
     
}
//
//  PieVC.swift
//  TabProgDemo
//
//  Created by Steven Lipton on 9/7/14.
//  Copyright (c) 2014 MakeAppPie.Com. All rights reserved.
//
 
import UIKit
 
class PieVC: UIViewController{
    var myOrder = OrderModel()
    // MARK: -Target Actions
     
    @IBOutlet weak var orderLabel: UILabel!
     
     
    @IBAction func orderButton(sender: UIButton) {
     //connect this to as many buttons as you need to list pies
        myOrder.pie = sender.titleLabel?.text
        orderLabel.text = myOrder.currentOrder()
    }
    //MARK: -Life Cycle
    override func viewWillAppear(animated: Bool) {
        super.viewWillAppear(animated)
        orderLabel.text = myOrder.currentOrder()
    }
     
    override func viewDidLoad() {
        super.viewDidLoad()
        let barViewControllers = self.tabBarController?.viewControllers
        let svc = barViewControllers![1] as! PizzaVC
        svc.myOrder = self.myOrder   //shared model, though not the best way
         
    }
     
}

