//
//  byJGViewController.m
//  byJG
//
//  Created by Ricardo Caratti on 18/08/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "byJGViewController.h"



@implementation byJGViewController

@synthesize cep, logradouro, bairro, cidade, uf;
@synthesize cepService;


-(void)metodoDelegadoCEP:(id)valor
{
	if([valor isKindOfClass: [NSError class]]) {
		return;
	}
    
	if([valor isKindOfClass: [SoapFault class]]) { 
		return;
	}
    
    NSString *strEnd = valor;
    
    
    if ( [strEnd hasPrefix:@"Logradouro"] ) {
        cep.text = @"#####-###";
        return;
    }
    
    NSArray  *endereco = [strEnd componentsSeparatedByCharactersInSet:[NSCharacterSet characterSetWithCharactersInString: @","]];
    
    cep.text = [endereco objectAtIndex:0];
    
    logradouro.text =  [endereco objectAtIndex:1];
    bairro.text = [endereco objectAtIndex:2];
    cidade.text = [endereco objectAtIndex:3]; 
    uf.text = [endereco objectAtIndex:4];     
    
}


-(void)metodoDelegadoLOGRADOURO:(id)valor
{
	if([valor isKindOfClass: [NSError class]]) {
		return;
	}
    
	if([valor isKindOfClass: [SoapFault class]]) { 
		return;
	}
        
    NSString *strEnd = valor;
    
    if ( [strEnd hasPrefix:@"Cep"] ) {
        //CEP não foi encontrado ou não é um CEP válido
        logradouro.text =  @"Logradouro não encontrado";
        bairro.text = @"-";
        cidade.text = @"-"; 
        uf.text = @"-"; 
        return;
    }
    
    NSArray  *endereco = [strEnd componentsSeparatedByCharactersInSet:[NSCharacterSet characterSetWithCharactersInString: @","]];
    
    logradouro.text =  [endereco objectAtIndex:0];
    bairro.text = [endereco objectAtIndex:1];
    cidade.text = [endereco objectAtIndex:2]; 
    uf.text = [endereco objectAtIndex:3]; 
}


-(IBAction)obtemServico:(id)sender
{

    // Verifica quais campos estão preenchidos para fazer a chamada correta. Isto é,  se  o CEP
    // estiver preenchido, chama o método para obter o endereço. Se o endereço estiver preenchido
    // busca o método para obter o CEP com base nas informaçães de endereço.
    
    NSString *cepAux = [cep.text stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceCharacterSet]];
    if ([cepAux length] == 0 ) {
        [cepService obterCEPAuth:self action:@selector(metodoDelegadoCEP:) logradouro:logradouro.text localidade:cidade.text UF:uf.text usuario:@"seu_usuario" senha:@"sua_senha"];
        
    }
    else {
        [cepService obterLogradouroAuth:self action:@selector(metodoDelegadoLOGRADOURO:) cep:cep.text usuario:@"seu_usuario" senha:@"sua_senha"]; 
        
    }
    
    [cep resignFirstResponder];
    
    
}


- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle


// Implement viewDidLoad to do additional setup after loading the view, typically from a nib.
- (void)viewDidLoad
{
    [super viewDidLoad];
    
    cepService = [[WSCEPCEPService alloc] init];
    cepService.logging = YES;
      
    
    
    
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
    
    self.cep = nil;
    self.logradouro = nil;
    self.bairro = nil;
    self.cidade = nil;
    self.uf = nil;
    
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

-(void) dealloc
{
    [cep release];
    [logradouro release];
    [bairro release];
    [cidade release];
    [uf release];
    [super dealloc];
}

@end
