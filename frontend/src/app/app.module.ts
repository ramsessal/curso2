import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { AvisosListaComponent } from './avisos-lista/avisos-lista.component';
import { ErroresInterceptor } from './servicios/errores.interceptor';
import { AvisoNuevoComponent } from './avisos-lista/aviso-nuevo.component';
import { EntrarComponent } from './entrar/entrar.component';

import { AuthInterceptor } from './interceptores/auth.interceptor';
  
@NgModule({
  declarations: [
    AppComponent,
    AvisosListaComponent,
    AvisoNuevoComponent,
    EntrarComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: ErroresInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: AuthInterceptor, multi: true }
  ],
  bootstrap: [AppComponent]
})      

export class AppModule { }
