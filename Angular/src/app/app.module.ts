import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { routing } from './app.routing';

import { HomeComponent } from './site/home/home.component';
import { AboutUsComponent } from './site/aboutus/aboutus.component';
import { ContactComponent } from './site/contact/contact.component';
import { TermsComponent } from './site/terms/terms.component';
import { RegisterComponent } from './user/register/register.component';
import { LoginComponent } from './user/login/login.component';

import { GamesComponent } from './game/games.component';
import { GameComponent } from './game/profile/game.component';
import { GenreGamesComponent } from './game/genregames/genregames.component';

import { AddGameComponent } from './admin/addgame/addgame.component';
import { AddRestComponent } from './admin/addrest/addrest.component';

import { SearchPipe } from './pipes/search';

import {CartComponent} from './user/cart/cart.component';
import {WishlistComponent} from './user/wishlist/wishlist.component';

import {GameService} from "./game/game.service";
import {SharedService} from "./shared/shared.service";
import {UserService} from "./user/user.service";
import {CartService} from "./user/cart/cart.service"

import {UserComponent} from "./user/user.component";
import {UserGamesComponent} from "./user/usergames/usergames.component";
import {AdminComponent} from "./admin/admin.component";



@NgModule({
  declarations: [
    AppComponent,
    TermsComponent,
    HomeComponent,
    AboutUsComponent,
    ContactComponent,
    RegisterComponent,
    LoginComponent,
    AddGameComponent,
    AddRestComponent,
    GamesComponent,
    GameComponent,
    GenreGamesComponent,
    CartComponent,
    WishlistComponent,
    SearchPipe,
    UserComponent,
    UserGamesComponent,
    AdminComponent
  ],
  imports: [
    BrowserModule,
    HttpModule,
    routing,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [
    GameService,
    SharedService,
    UserService,
    CartService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
