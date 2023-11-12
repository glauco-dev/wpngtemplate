import { Component , OnInit} from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterOutlet } from '@angular/router';
import { NgwpThemeKitModule } from 'ngwp-theme-kit';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet, NgwpThemeKitModule],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {
  title = 'integrachagasclient';
}


@Component({
  selector: 'intch-wppage-NgWrapper',
  template: `<strong>hi from intch-wppage-NgWrapper!</strong>`
})

export class WpPage implements OnInit {
  constructor() { }

  ngOnInit() { }
}

@Component({
  selector: 'intch-wppage-NgWrapper',
  template: `<strong>hi from intch-wppost-NgWrapper!</strong>`
})

export class WpPost implements OnInit {
  constructor() { }

  ngOnInit() { }
}

NgwpThemeKitModule.setPageTemplate(WpPage);
NgwpThemeKitModule.setPostTemplate(WpPost);