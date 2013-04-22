//
//  byJGViewController.h
//  byJG
//
//  Created by Ricardo Caratti on 18/08/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "WSCEPCEPService.h"

@interface byJGViewController : UIViewController 
{
    IBOutlet UITextField *cep;
    IBOutlet UITextField *logradouro;
    IBOutlet UITextField *bairro;
    IBOutlet UITextField *cidade;
    IBOutlet UITextField *uf;
    
    WSCEPCEPService *cepService;
}

@property (nonatomic, retain)   IBOutlet UITextField *cep;
@property (nonatomic, retain)   IBOutlet UITextField *logradouro;
@property (nonatomic, retain)   IBOutlet UITextField *bairro;
@property (nonatomic, retain)   IBOutlet UITextField *cidade;
@property (nonatomic, retain)   IBOutlet UITextField *uf;
@property (nonatomic, retain)   WSCEPCEPService *cepService;

-(IBAction)obtemServico:(id)sender;
-(void)metodoDelegadoCEP:(id) valor;
-(void)metodoDelegadoLOGRADOURO:(id) valor;

@end
