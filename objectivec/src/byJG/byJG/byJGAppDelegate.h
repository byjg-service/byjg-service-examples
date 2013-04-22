//
//  byJGAppDelegate.h
//  byJG
//
//  Created by Ricardo Caratti on 18/08/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@class byJGViewController;

@interface byJGAppDelegate : NSObject <UIApplicationDelegate>

@property (nonatomic, retain) IBOutlet UIWindow *window;

@property (nonatomic, retain) IBOutlet byJGViewController *viewController;

@end
